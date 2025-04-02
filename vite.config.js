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
                'resources/css/components/edit-text-input.css',
                'resources/css/components/video-grid.css',
                'resources/css/components/video-card.css',
                'resources/css/components/profile.css',
                //pages styles
                'resources/css/pages/chat.css',
                'resources/css/pages/profile.css',
                'resources/css/pages/watch.css',
                //layouts scripts 
                'resources/js/app.js',
                //pages scripts
                'resources/js/pages/chat.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
