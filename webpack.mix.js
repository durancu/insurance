const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')

    .copyDirectory('resources/views/site/assets/fonts', 'public/assets/fonts')
    .copyDirectory('resources/views/site/assets/img', 'public/assets/img')
    .styles(['resources/views/site/assets/css/app.css'], 'public/assets/css/app.css');
