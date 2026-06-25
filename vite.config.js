import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            publicDirectory: '../simklinik-backend/public',
            buildDirectory: 'build',
            hotFile: '../simklinik-backend/public/hot',
            refresh: [
                '../simklinik-backend/routes/**',
                '../simklinik-backend/app/**',
                'resources/views/**',
            ],
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/simklinik-backend/storage/framework/views/**'],
        },
    },
});
