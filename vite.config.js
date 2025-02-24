import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
    build: {
        outDir: path.resolve(__dirname, 'public'),
        rollupOptions: {
            input: {
                main: path.resolve(__dirname, 'resources/js/cookies-consent.js'),
            },
            output: {
                entryFileNames: 'cookies-consent.js',
                assetFileNames: 'cookies-consent.css',
            },
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources'),
        },
    },
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import "@/styles/_variables.css";` // Import variables globally
            },
        },
    },
});
