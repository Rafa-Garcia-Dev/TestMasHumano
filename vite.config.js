import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.scss',
                    'resources/js/app.js',
                    'resources/js/client/client.js',
                    'resources/js/docTypes/docTypes.js',
                    'resources/js/reserve/reserve.js',
                    'resources/js/reserve/modifyReserve.js'
                    ],
            refresh: true,
        }),
    ],
});
