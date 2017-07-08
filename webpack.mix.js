const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');


mix.styles([
    'public/themes/wibs/pages/css/font-awesome.css',
    'public/themes/wibs/pages/css/bootstrap.css',
    'public/themes/wibs/pages/css/notify__custom.css',
    'public/themes/wibs/pages/css/nprogress.css',
    'public/themes/wibs/pages/css/animate.css',
    'public/themes/wibs/pages/css/custom.css',
    'public/js/bower_components/pacejs/pace-theme-flash.css',
    'public/js/bower_components/iCheck/skins/flat/flat.css',
    'public/themes/wibs/pages/css/pop__up.css',
    'public/js/bower_components/hold-on/HoldOn.min.css',
    'public/js/bower_components/sweetalert/dist/sweetalert.css',
    'public/js/bower_components/icheck-bootstrap/icheck-bootstrap.min.css',
    'public/js/bower_components/custom-scrollbar/jquery.mCustomScrollbar.min.css',
], 'public/themes/wibs/pages/build/css/style.css');

mix.scripts([
	'public/js/bower_components/jquery/dist/jquery.min.js',
	'public/js/bower_components/jquery/dist/jquery-ui.js',
    'public/js/bower_components/iCheck/icheck.min.js',
	'public/js/bower_components/hold-on/HoldOn.min.js',
	'public/js/bower_components/sweetalert/dist/sweetalert.min.js',
    'public/js/bower_components/notifyjs/dist/notify.js',
    'public/js/bower_components/gsap/src/minified/TweenMax.min.js',
    'public/js/bower_components/pnotify/dist/pnotify.js',
    'public/js/bower_components/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js',
], 'public/themes/wibs/pages/build/js/plugins.js');

mix.scripts([
	'public/themes/wibs/pages/js/bootstrap.min.js',
	//'public/js/bower_components/pacejs/pace.js',
	'public/themes/wibs/pages/js/custom.min.js',
	'public/themes/wibs/pages/js/nprogress.js',
], 'public/themes/wibs/pages/build/js/core.js');