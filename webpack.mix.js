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

mix.react('resources/js/app.js', 'public/js');
   // .sass('resources/sass/admin.scss', 'public/admin_assets/css')
   // .sass('Modules/Admin/Resources/assets/sass/admin-login.scss', 'public/admin_assets/css')
   // .sass('Modules/Chat/Resources/assets/sass/chat.scss', 'public/chat_assets/css')
   // .sass('resources/sass/front.scss', 'public/css')
   // .sass('resources/sass/app.scss', 'public/css');
