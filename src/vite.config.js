import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/sass/main/main.scss', 
                'resources/sass/admin/admin.scss', 

                'resources/js/main/main.js',
                'resources/js/admin/admin.js',
            ],
            refresh: true,
        }),
    ],
});
