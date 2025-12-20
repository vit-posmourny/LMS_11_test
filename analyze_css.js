import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

// ES Module ekvivalent pro __dirname, protože není v ES modulech k dispozici
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// === KONFIGURACE CEST ===
// Upravte, pokud se vaše složky jmenují jinak
const cssFile = path.join(__dirname, 'resources/css/global.css');
const viewsDir = path.join(__dirname, 'resources/views');

// Složky k vynechání (absolutní cesty)
const excludedPaths = [
    path.join(viewsDir, 'edu-core-frontend'),
    path.join(viewsDir, 'admin-template')
];

// Ověření existence souborů
if (!fs.existsSync(cssFile)) {
    console.error(`Chyba: Soubor ${cssFile} nebyl nalezen.`);
    console.error('Ujistěte se, že spouštíte skript z kořene projektu.');
    process.exit(1);
}

if (!fs.existsSync(viewsDir)) {
    console.error(`Chyba: Složka ${viewsDir} nebyla nalezena.`);
    process.exit(1);
}

// Funkce pro extrakci selektorů z CSS
function extractSelectors(css) {
    // Odstranění komentářů
    css = css.replace(/\/\*[\s\S]*?\*\//g, '');

    const selectors = [];
    let currentSelector = '';

    // Jednoduchý parser: hledá řetězce před znakem '{'
    for (let i = 0; i < css.length; i++) {
        const char = css[i];
        if (char === '{') {
            const sel = currentSelector.trim();
            // Ignorujeme @media, @keyframes atd.
            if (sel && !sel.startsWith('@')) {
                // Rozdělení více selektorů oddělených čárkou
                sel.split(',').forEach(s => {
                    const cleaned = s.trim();
                    if (cleaned) selectors.push(cleaned);
                });
            }
            currentSelector = '';
        } else if (char === '}') {
            currentSelector = '';
        } else {
            currentSelector += char;
        }
    }
    // Vrátíme unikátní selektory
    return [...new Set(selectors)];
}

// Funkce pro získání "tokenů" (tříd a ID) ze selektoru pro vyhledávání
function getSearchTokens(selector) {
    // Regex hledá .trida a #id
    const regex = /([.#])(-?[_a-zA-Z]+[_a-zA-Z0-9-]*)/g;
    const tokens = [];
    let match;
    while ((match = regex.exec(selector)) !== null) {
        // Uložíme název bez tečky nebo křížku (např. "form-control")
        tokens.push(match[0].substring(1));
    }
    return tokens;
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
            fileList.push(filePath);
        }
    });
    return fileList;
}

console.log('Analyzuji soubory...');

// 1. Načtení a parsování CSS
const cssContent = fs.readFileSync(cssFile, 'utf8');
const selectors = extractSelectors(cssContent);

// 2. Načtení všech souborů ve views
const viewFiles = walk(viewsDir);

// 3. Vyhledávání
const results = {};

selectors.forEach(selector => {
    const tokens = getSearchTokens(selector);

    // Pokud selektor neobsahuje třídu ani ID (např. je to jen "textarea"),
    // přeskočíme ho, protože by dával příliš mnoho obecných výsledků.
    if (tokens.length === 0) return;

    results[selector] = new Set();

    viewFiles.forEach(file => {
        const content = fs.readFileSync(file, 'utf8');

        // Zjednodušená kontrola: soubor musí obsahovat VŠECHNY třídy/ID ze selektoru
        const isMatch = tokens.every(token => content.includes(token));

        if (isMatch) {
            // Získání relativní cesty od složky views
            const relPath = path.relative(viewsDir, file);
            results[selector].add(relPath);
        }
    });
});

// 4. Výpis výsledků
console.log('\n=== VÝSLEDEK ANALÝZY ===\n');
let foundCount = 0;

for (const [selector, files] of Object.entries(results)) {
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

        console.log(`Pravidlo: ${selector}`);
        console.log(`Použito v: ${outputParts.join(', ')}`);
        console.log('------------------------------------------------');
        foundCount++;
    }
}

if (foundCount === 0) {
    console.log('Nebyla nalezena žádná přímá shoda pro pravidla z global.css.');
} else {
    console.log(`Nalezeno využití u ${foundCount} pravidel.`);
}
