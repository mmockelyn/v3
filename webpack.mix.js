const mix = require('laravel-mix');
let LiveReloadPlugin = require('webpack-livereload-plugin');

mix.copyDirectory('resources/demo5/src/assets/media', 'public/assets/media');
mix.disableNotifications();

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/index.js', 'public/js')

    .js('resources/js/auth/login.js', 'public/js/auth')

    .js('resources/js/account/index.js', 'public/js/account')
    .js('resources/js/account/account.js', 'public/js/account')


    .sass('resources/sass/app.scss', 'public/css');

mix.webpackConfig({
    resolve: {
        alias: {
            'morris.js': 'morris.js/morris.js',
            'jquery-ui': 'jquery-ui',
        },
    },
    plugins: [
        new LiveReloadPlugin()
    ]
});
