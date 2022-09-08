import { defineConfig } from 'vite';
const { resolve } = require('path');
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path'

export default defineConfig({
    resolve: {
        alias: {
            '@': resolve('./resources/js'),
            ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue'),

        },
    },
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: false,
        }),
    ],
});
