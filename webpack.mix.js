const mix = require("laravel-mix");

mix.js("resources/js/main.js", "public/js").sass(
    "resources/sass/main.scss",
    "public/css"
).sourceMaps();

if (mix.inProduction()) {
    mix.version();
}

mix.webpackConfig({
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js")
        }
    }
});
