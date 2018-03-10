let mix = require('laravel-mix');

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

mix.js('resources/assets/js/synced.js', 'public/js');
mix.js('resources/assets/js/deferred.js', 'public/js');
mix.sass('resources/assets/sass/synced.scss', 'public/css');
mix.sass('resources/assets/sass/deferred.scss', 'public/css');
mix.copyDirectory('resources/assets/images', 'public/images');
mix.version();
