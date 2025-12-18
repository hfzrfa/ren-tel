import { defineConfig } from "vite";
import path from "node:path";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";
import react from "@vitejs/plugin-react";

export default defineConfig({
    plugins: [
        react({
            fastRefresh: false,
        }),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            resources: path.resolve(__dirname, "resources"),
            "@": path.resolve(__dirname, "resources/js"),
        },
    },
});
