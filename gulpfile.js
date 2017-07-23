process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');
var gulp = require("gulp");

var js_path = './public/themes/wibs/msc/js/';
var css_path = './public/themes/wibs/msc/css/';
var bower_path = './public/js/bower_components/';

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

     // for plugin css
    mix.styles([
        'animate.css',
        'bootstrap.css',
        'custom.css',
        'font-awesome.css',
        'notify__custom.css'
        'nprogress.css',
        'pop__up.css'
    ], 'public/cms/css/style.css', css_path);

     // for bower_components plugin css
    mix.styles([
        'pacejs/pace-theme-flash.css',
        'iCheck/skins/flat/flat.css',
        'hold-on/HoldOn.min.css',
        'sweetalert/dist/sweetalert.css',
        'icheck-bootstrap/icheck-bootstrap.min.css',
        'custom-scrollbar/jquery.mCustomScrollbar.min.css'
    ], 'public/cms/css/style.css', bower_path);
    


    // for bower_components plugin js
    mix.scripts([
        'jquery/dist/jquery.min.js',
        'jquery/dist/jquery-ui.js',
        'iCheck/icheck.min.js',
        'hold-on/HoldOn.min.js',
        'sweetalert/dist/sweetalert.min.js',
        'notifyjs/dist/notify.js',
        'gsap/src/minified/TweenMax.min.js',
        'pnotify/dist/pnotify.js',
        'custom-scrollbar/jquery.mCustomScrollbar.concat.min.js'
    ], 'public/themes/wibs/msc/build/js/plugins.js', bowerDir);

    // for plugin js
    mix.scripts([
        'bootstrap.min.js',
        'custom.min.js',
        'nprogress.js',
    ], 'ppublic/themes/wibs/msc/build/js/core.js', js_path);
});
