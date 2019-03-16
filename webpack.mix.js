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
/*
* mix for backend
*/
mix.js('resources/js/backend/app.js', 'public/backend/js/')
   .sass('resources/sass/backend/app.scss', 'public/backend/css/').version();

mix.sass('resources/sass/backend/main.scss', 'public/backend/css/');
/*
* mix for Front end
*/
mix.js('resources/js/frontend/app.js', 'public/frontend/js')
   .sass('resources/sass/frontend/app.scss', 'public/frontend/css').version();

mix.styles([
    'resources/sass/backend/style.css',
], 'public/backend/css/theme.css').version();

mix.scripts([
   'resources/js/backend/vendor/detect.js',
   'resources/js/backend/vendor/fastclick.js',
   'resources/js/backend/vendor/jquery.blockUI.js',
   'resources/js/backend/vendor/waves.js',
   'resources/js/backend/vendor/jquery.nicescroll.js',
   'resources/js/backend/vendor/jquery.scrollTo.min.js',
   'resources/js/backend/vendor/jquery.slimscroll.js',
   'resources/js/backend/vendor/modernizr.min.js',
   'resources/js/backend/vendor/jquery.app.js',
], 'public/backend/js/vendor.js');

mix.js('resources/js/backend/custom.js', 'public/backend/js');
