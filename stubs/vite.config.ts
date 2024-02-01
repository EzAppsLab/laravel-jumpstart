import {fileURLToPath, URL} from 'node:url'
import {defineConfig} from 'vite'
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
import dotenv from "dotenv"

dotenv.config()

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/ts/app.ts',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/ts', import.meta.url))
        }
    },
    server: {
        // https: true,
        host: process.env.VITE_SERVER_HOST || '127.0.0.1',
        watch: {
            usePolling: true,
            ignored: [
                "**/vendor/**"
            ]
        }
    }
})
