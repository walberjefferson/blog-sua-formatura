const mix = require('laravel-mix');
const bs = require('browser-sync').create();

mix.sass('resources/sass/custom.scss', 'css/');
mix.js('resources/js/custom.js', 'js/app.js');

mix.styles('resources/css/custom.css', 'css/app.css');

mix.styles([
    'resources/assets/bootstrap/css/bootstrap.min.css',
    'resources/assets/select2/css/select2.min.css',
    'resources/assets/magnific-popup/css/magnific-popup.css',
    'resources/css/animate.css',
    'resources/assets/bxslider/css/bxslider.min.css',
    'resources/assets/owl-carousel/css/owl.carousel.min.css',
], 'css/all.css');

mix.scripts([
    'resources/js/popper.min.js',
    'resources/assets/bootstrap/js/bootstrap.min.js',
    'resources/assets/select2/js/select2.min.js',
    'resources/assets/magnific-popup/js/magnific-popup.min.js',
    'resources/assets/masonry/js/masonry.min.js',
    'resources/assets/isotope/js/isotope.min.js',
    'resources/assets/bxslider/js/bxslider.min.js',
    'resources/assets/owl-carousel/js/owl.carousel.min.js',
    'resources/assets/waypoints/js/waypoints.min.js',
    'resources/assets/counterup/js/counterup.min.js',
    'resources/assets/countdown/js/countdown.js',
], 'js/all.js');

mix.copyDirectory('resources/assets/font-awesome', 'assets/font-awesome');
mix.copyDirectory('resources/assets/iconmoon', 'assets/iconmoon');


if(!mix.inProduction()){
    bs.init({
        proxy: 'sua-formatura.test',
        port: 3000,
        files: [
            "css/*.css",
            "js/*.js",
            "**/*.php",
        ]
    });
}
// mix.disableNotifications();