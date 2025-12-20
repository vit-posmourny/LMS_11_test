import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

// ES Module ekvivalent pro __dirname
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// === KONFIGURACE CEST ===
const viewsDir = path.join(__dirname, 'resources/views');

// Složky k vynechání (absolutní cesty)
const excludedPaths = [
    path.join(viewsDir, 'edu-core-frontend'),
    path.join(viewsDir, 'admin-template')
];

// Komponenty k vyhledání
// filename: název souboru pro výpis
// tagName: název tagu v Blade šabloně (např. <x-input-block ...)
const componentsToAnalyze = [
    { filename: 'input-block.blade.php', tagName: 'x-input-block' },
    { filename: 'input-file-block.blade.php', tagName: 'x-input-file-block' }
];

// Ověření existence složky views
if (!fs.existsSync(viewsDir)) {
    console.error(`Chyba: Složka ${viewsDir} nebyla nalezena.`);
    process.exit(1);
}

// Rekurzivní procházení složky views
function walk(dir, fileList = []) {
    const files = fs.readdirSync(dir);
    files.forEach(file => {
        const filePath = path.join(dir, file);
        const stat = fs.statSync(filePath);
        if (stat.isDirectory()) {
            if (excludedPaths.includes(filePath)) {
                return;
            }
            walk(filePath, fileList);
        } else {
            // Hledáme jen v .blade.php souborech
            if (file.endsWith('.blade.php')) {
                fileList.push(filePath);
            }
        }
    });
    return fileList;
}

console.log('Analyzuji použití komponent...');

const viewFiles = walk(viewsDir);
const results = {};

// Inicializace výsledků
componentsToAnalyze.forEach(comp => {
    results[comp.filename] = new Set();
});

viewFiles.forEach(file => {
    const content = fs.readFileSync(file, 'utf8');

    componentsToAnalyze.forEach(comp => {
        // Regex hledá <x-nazev následovaný mezerou, novým řádkem, lomítkem nebo koncem tagu
        // Tím se zabrání falešným shodám jako <x-input-block-item
        const regex = new RegExp(`<${comp.tagName}([\\s/>]|$)`);

        if (regex.test(content)) {
            const relPath = path.relative(viewsDir, file);
            results[comp.filename].add(relPath);
        }
    });
});

// Výpis výsledků
console.log('\n=== VÝSLEDEK ANALÝZY KOMPONENT ===\n');

for (const [component, files] of Object.entries(results)) {
    console.log(`Komponenta: ${component}`);

    if (files.size > 0) {
        const usageMap = new Map();

        files.forEach(fileRelPath => {
            const parts = fileRelPath.split(path.sep);
            let groupName;
            let detail = null;

            if (parts.length === 1) {
                groupName = 'views (root)';
            } else {
                const folder = parts[0];
                groupName = `views/${folder}`;
                // Pokud je to ve složce components, chceme vidět detail (název souboru)
                if (folder === 'components') {
                    detail = parts.slice(1).join('/');
                }
            }

            if (!usageMap.has(groupName)) {
                usageMap.set(groupName, new Set());
            }
            if (detail) {
                usageMap.get(groupName).add(detail);
            }
        });

        const outputParts = [];
        for (const [group, details] of usageMap.entries()) {
            if (group === 'views/components' && details.size > 0) {
                outputParts.push(`${group} (${Array.from(details).join(', ')})`);
            } else {
                outputParts.push(group);
            }
        }

        console.log(`Použito v: ${outputParts.join(', ')}`);
    } else {
        console.log('Použito v: (nikde nenalezeno)');
    }
    console.log('------------------------------------------------');
}
