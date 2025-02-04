import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                 'resources/js/app.js',
                 'resources/js/scripts.js',
                 'resources/js/bootstrap.js',
                 'resources/js/datatables-simple-demo.js',
                 'resources/css/bootstrap.min.css',
                 'resources/css/styles.css'
                ],
            refresh: true,
        }),
    ],
});
