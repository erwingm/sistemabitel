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

mix.styles([
    'resources/assets/plantilla/css/font-awesome.min.css',
    'resources/assets/plantilla/css/simple-line-icons.min.css',
    'resources/assets/plantilla/css/main.css'
], 'public/css/plantilla.css')
.scripts([
    'resources/assets/plantilla/js/jquery-3.2.1.min.js',
    'resources/assets/plantilla/js/popper.min.js',
    'resources/assets/plantilla/js/bootstrap.min.js',
    'resources/assets/plantilla/js/chart.js',
    'resources/assets/plantilla/js/pace.min.js',
    'resources/assets/plantilla/js/main.js'
],'public/js/plantilla.js')

.js(['resources/assets/js/app.js'],'public/js/app.js');