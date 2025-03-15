import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //layouts styles
                'resources/css/app.css',
                'resources/css/auth.css',
                'resources/css/player.css',
                //components styles
                'resources/css/components/image-input.css',
                'resources/css/components/navbar.css',
                //pages styles
                'resources/css/pages/profile.css',
                //layouts scripts 
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
