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

    .copyDirectory('resources/views/template/html/css', 'public/assets/css')
    .copyDirectory('resources/views/template/html/img', 'public/assets/img')
    .copyDirectory('resources/views/template/html/js', 'public/assets/js')
    .copyDirectory('resources/views/template/html/layerslide', 'public/assets/layerslide')
    .copyDirectory('resources/views/template/html/media', 'public/assets/media')
    .styles(['resources/views/site/assets/css/app.css'], 'public/assets/css/app.css');
