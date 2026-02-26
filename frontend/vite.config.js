import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";
import { fileURLToPath, URL } from "node:url";
import { VitePWA } from "vite-plugin-pwa"; // You need to import this!

export default defineConfig(({ mode }) => ({
    // Add mode parameter for devOptions
    plugins: [
        tailwindcss(),
        vue(),
        VitePWA({
            registerType: "autoUpdate",
            strategies: "generateSW",
            includeAssets: [
                "favicon.ico",
                "apple-touch-icon.png",
                "vite.svg",
                "src/assets/images/profile-nEVPe_16.png",
            ],
            manifest: {
                name: "Elibray Management System",
                short_name: "Elibray",
                description:
                    "PDF File Management by Agentos Professional webapp",
                theme_color: "#ffffff",
                background_color: "#ffffff",
                display: "standalone",
                orientation: "any",
                scope: "/",
                start_url: "/",
                icons: [
                    {
                        src: "/pwa-192x192-rounded.png",
                        sizes: "192x192",
                        type: "image/png",
                        purpose: "any maskable",
                    },
                    {
                        src: "/pwa-512x512-rounded.png",
                        sizes: "512x512",
                        type: "image/png",
                        purpose: "any maskable",
                    },
                ],
            },
            workbox: {
                maximumFileSizeToCacheInBytes: 5 * 1024 * 1024,
                globPatterns: [
                    "**/*.{js,css,html,ico,png,svg,jpg,jpeg,webp,woff2,ttf}",
                ],
                runtimeCaching: [
                    {
                        urlPattern: /^https:\/\/fonts\.googleapis\.com\/.*/i,
                        handler: "CacheFirst",
                        options: {
                            cacheName: "google-fonts-cache",
                            expiration: {
                                maxEntries: 10,
                                maxAgeSeconds: 60 * 60 * 24 * 365,
                            },
                            cacheableResponse: {
                                statuses: [0, 200],
                            },
                        },
                    },
                    {
                        urlPattern: /^https:\/\/fonts\.gstatic\.com\/.*/i,
                        handler: "CacheFirst",
                        options: {
                            cacheName: "gstatic-fonts-cache",
                            expiration: {
                                maxEntries: 10,
                                maxAgeSeconds: 60 * 60 * 24 * 365,
                            },
                            cacheableResponse: {
                                statuses: [0, 200],
                            },
                        },
                    },
                ],
                navigateFallback: null,
            },
            devOptions: {
                enabled: mode === "development", // Now mode is defined
                type: "module",
            },
        }),
    ],
    server: {
        host: "0.0.0.0",
        port: process.env.VITE_HMR_PORT || 5173,
        hmr: {
            protocol: "ws",
            port: process.env.VITE_HMR_PORT || 5173,
        },
        watch: {
            usePolling: true,
            useFsEvents: true,
            interval: 1000,
        },
    },
    resolve: {
        alias: {
            "@": fileURLToPath(new URL("./src", import.meta.url)),
            "@com": fileURLToPath(new URL("./src/components", import.meta.url)),
            "@func": fileURLToPath(new URL("./src/functions", import.meta.url)),
            "@assets": fileURLToPath(new URL("./src/assets", import.meta.url)),
        },
    },
}));
