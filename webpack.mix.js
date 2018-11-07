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

mix.js('resources/assets/js/base.js', 'public/js')
    .js('resources/assets/js/public.js', 'public/js')
    .js('resources/assets/js/admin.js', 'public/js')
    .sass('resources/assets/sass/public.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css')
    .copy('resources/assets/img', 'public/img')


    .combine([
           'node_modules/datatables.net/js/jquery.dataTables.js',
           'node_modules/datatables.net-bs/js/dataTables.bootstrap.js',
           'node_modules/datatables.net/js/jquery.dataTables.js',
           'node_modules/datatables.net-responsive/js/dataTables.responsive.js',
           'node_modules/select2/dist/js/select2.min.js',
           'node_modules/toastr/build/toastr.min.js',
           'node_modules/moment/min/moment.min.js',
           'node_modules/moment/moment.js',
           'node_modules/daterangepicker/daterangepicker.js',
           './vendor/proengsoft/laravel-jsvalidation/public/js/jsvalidation.js',
           'node_modules/switchery/standalone/switchery.js',
    ], 'public/js/resources.js')

    .combine([
            'node_modules/datatables.net-bs/css/dataTables.bootstrap.css',
            'node_modules/datatables.net-responsive-bs/css/responsive.bootstrap.css',
            'node_modules/select2/dist/css/select2.min.css',
            'node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css',
            'node_modules/toastr/build/toastr.min.css',
            'node_modules/daterangepicker/daterangepicker.css',
            'node_modules/switchery/standalone/switchery.css',
    ], 'public/css/resources.css')

    .version();
