const mix = require('laravel-mix');
const bs = require('browser-sync').create();

mix.sass('resources/sass/custom.scss', 'css/');
mix.js('resources/js/custom.js', 'js/app.js');

mix.styles('resources/css/custom.css', 'css/app.css');

mix.styles([
    'resources/assets/bootstrap/css/bootstrap.min.css',
    'resources/assets/select2/css/select2.min.css',
    'resources/css/animate.css',
], 'css/all.css');

mix.scripts([
    'resources/js/popper.min.js',
    'resources/assets/bootstrap/js/bootstrap.min.js',
    'resources/assets/select2/js/select2.min.js',
    'resources/assets/masonry/js/masonry.min.js',
], 'js/all.js');


bs.init({
    proxy: 'sua-formatura.test',
    port: 3000,
    files: [
        "css/*.css",
        "js/*.js",
        "**/*.php",
    ]
});

// mix.disableNotifications();