import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import createSvgSpritePlugin from 'vite-plugin-svg-sprite';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/css/frontend.css',
                'resources/css/global.css',
                'resources/js/app.js',
                'resources/js/admin/login.js',
                'resources/js/admin/admin.js',
                'resources/js/admin/course.js',
                'resources/js/frontend/course.js',
                'resources/js/frontend/player.js',
                'resources/js/frontend/frontend.js',
            ],
            refresh: true,
        }),
        createSvgSpritePlugin({
        // Určete, kde jsou Vaše zdrojové SVG ikony
        include: 'frontend/assets/images/social media/*.svg',

        // Cesta k adresáři s ikony (relativně k root adresáři projektu)
        // např. /src/assets/icons/*.svg

        // Volitelné: Nastavení ID pro jednotlivé symboly
        // [name] bude nahrazeno názvem souboru ikony (např. home.svg -> icon-home)
        symbolId: 'icon-[name]',

        // Volitelné: Optimalizace SVG pomocí SVGO (doporučeno)
        svgo: true,

        // ExportType 'vanilla' vrátí ID symbolu, který použijete v <use>
        exportType: 'vanilla',

        outputDir: 'public/build/assets',
    }),
    ],
});



