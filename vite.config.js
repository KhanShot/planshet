import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/style.css',
                'resources/js/main.js',
                'resources/js/jquery.min.js'
            ],
            refresh: true,
        }),
    ],
});
