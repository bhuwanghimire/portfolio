import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',
                // Frontend Entry Points
                'resources/js/frontend/main.js',
                'resources/js/frontend/main.css',],

            refresh: true,
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            '@frontend': '/resources/js/frontend',
        },
    },
    server: {
        cors: true,
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
