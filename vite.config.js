import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

/**
 * Vite configuration for Laravel project.
 * Includes CSS and JS entry points.
 * Supports hot module replacement in development.
 */
export default defineConfig(({ command }) => {
    return {
        plugins: [
            laravel({
                input: ["resources/css/app.css", "resources/js/app.js"],
                refresh: command === "serve", // Enable refresh only in dev mode
            }),
        ],
        build: {
            sourcemap: command === "serve", // Enable sourcemaps in dev for easier debugging
            minify: command === "build", // Minify only in production build
        },
        resolve: {
            alias: {
                "@": "/resources/js", // Example alias for JS imports
            },
        },
    };
});
