const mix = require('laravel-mix');
const {js} = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ])

    .postCss('resources/css/tom-select.css', 'public/css')
    .postCss('resources/css/demo-styles.css', 'public/css')

    .js('resources/js/tom-select.js', 'public/js')
    .js('resources/js/jquery.multi-select.js', 'public/js')

if (mix.inProduction()) {
    mix.version();
}
