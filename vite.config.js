import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/css/frontend.css',
                'resources/css/global.css',
                'resources/css/admin/style.css',
                'resources/css/frontend/style.css',
                'resources/css/tom-select.css',
                'resources/js/app.js',
                'resources/js/admin/login.js',
                'resources/js/admin/admin.js',
                'resources/js/admin/course.js',
                'resources/js/frontend/course.js',
                'resources/js/frontend/player.js',
                'resources/js/frontend/frontend.js',
                'resources/js/admin/tinymce-init.js',
                'resources/js/analyzeImages.js',
                'resources/js/tom-select-ini.js',
            ],
            refresh: true,
        }),
    ],
});
