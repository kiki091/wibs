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


mix.styles([
    'public/themes/wibs/msc/css/font-awesome.css',
    'public/themes/wibs/msc/css/bootstrap.css',
    'public/themes/wibs/msc/css/notify__custom.css',
    'public/themes/wibs/msc/css/nprogress.css',
    'public/themes/wibs/msc/css/animate.css',
    'public/themes/wibs/msc/css/custom.css',
    'public/js/bower_components/pacejs/pace-theme-flash.css',
    'public/js/bower_components/iCheck/skins/flat/flat.css',
    'public/themes/wibs/msc/css/pop__up.css',
    'public/js/bower_components/hold-on/HoldOn.min.css',
    'public/js/bower_components/sweetalert/dist/sweetalert.css',
    'public/js/bower_components/icheck-bootstrap/icheck-bootstrap.min.css',
    'public/js/bower_components/custom-scrollbar/jquery.mCustomScrollbar.min.css',
], 'public/themes/wibs/msc/build/css/style.css');

mix.scripts([
	'public/js/bower_components/jquery/dist/jquery.min.js',
	'public/js/bower_components/jquery/dist/jquery-ui.js',
    'public/js/bower_components/iCheck/icheck.min.js',
	'public/js/bower_components/hold-on/HoldOn.min.js',
	'public/js/bower_components/sweetalert/dist/sweetalert.min.js',
    'public/js/bower_components/notifyjs/dist/notify.js',
    'public/js/bower_components/gsap/src/minified/TweenMax.min.js',
    'public/js/bower_components/pnotify/dist/pnotify.js',
    'public/js/bower_components/morris.js/morris.min.js',
    'public/js/bower_components/bootstrap-progressbar/bootstrap-progressbar.js',
    'public/js/bower_components/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js',
], 'public/themes/wibs/msc/build/js/plugins.js');

mix.scripts([
	'public/themes/wibs/msc/js/bootstrap.min.js',
	//'public/js/bower_components/pacejs/pace.js',
	'public/themes/wibs/msc/js/custom.min.js',
	'public/themes/wibs/msc/js/nprogress.js',
], 'public/themes/wibs/msc/build/js/core.js');

// AUTH


mix.styles([
    'public/themes/wibs/auth/css/font-awesome.css',
    'public/themes/wibs/auth/css/bootstrap.css',
    'public/themes/wibs/auth/css/notify__custom.css',
    'public/themes/wibs/auth/css/nprogress.css',
    'public/themes/wibs/auth/css/animate.css',
    'public/themes/wibs/auth/css/custom.css',
    'public/js/bower_components/pacejs/pace-theme-flash.css',
    'public/js/bower_components/iCheck/skins/flat/flat.css',
    'public/themes/wibs/auth/css/pop__up.css',
    'public/js/bower_components/hold-on/HoldOn.min.css',
    'public/js/bower_components/sweetalert/dist/sweetalert.css',
    'public/js/bower_components/icheck-bootstrap/icheck-bootstrap.min.css',
    'public/js/bower_components/custom-scrollbar/jquery.mCustomScrollbar.min.css',
    'public/js/bower_components/bootstrap-clockpicker/bootstrap-clockpicker.css',
], 'public/themes/wibs/auth/build/css/style.css');

mix.scripts([
    'public/js/bower_components/jquery/dist/jquery.min.js',
    'public/js/bower_components/jquery/dist/jquery-ui.js',
    'public/js/bower_components/iCheck/icheck.min.js',
    'public/js/bower_components/hold-on/HoldOn.min.js',
    'public/js/bower_components/sweetalert/dist/sweetalert.min.js',
    'public/js/bower_components/notifyjs/dist/notify.js',
    'public/js/bower_components/gsap/src/minified/TweenMax.min.js',
    'public/js/bower_components/pnotify/dist/pnotify.js',
    'public/js/bower_components/morris.js/morris.min.js',
    'public/js/bower_components/bootstrap-progressbar/bootstrap-progressbar.js',
    'public/js/bower_components/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js',
    'public/js/bower_components/bootstrap-clockpicker/bootstrap-clockpicker.js',
    'public/js/bower_components/masonry/dist/masonry.pkgd.js',
], 'public/themes/wibs/auth/build/js/plugins.js');

mix.scripts([
    'public/themes/wibs/auth/js/bootstrap.min.js',
    //'public/js/bower_components/pacejs/pace.js',
    'public/themes/wibs/auth/js/custom.min.js',
    'public/themes/wibs/auth/js/nprogress.js',
], 'public/themes/wibs/auth/build/js/core.js');