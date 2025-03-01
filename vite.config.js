import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //layout styles
                'resources/css/app.css', 
                'resources/css/auth.css',
                'resources/css/player.css',
                'resources/css/scout.css',
                //component styles
                'resources/css/components/text-input.css',
                'resources/css/components/primary-button.css',
                'resources/css/components/secundary-button.css',
                //layout scripts
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
