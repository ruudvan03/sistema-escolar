import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss', // Asegúrate de que esta ruta sea la correcta
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                // Esto silencia las advertencias de las dependencias (como Bootstrap)
                quietDeps: true,
                // Esto silencia advertencias específicas de las nuevas versiones de Sass
                silenceDeprecations: ['import', 'global-builtin', 'color-functions', 'mixed-decls', 'if-function'],
            },
        },
    },
});