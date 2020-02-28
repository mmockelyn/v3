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

    .js('resources/js/blog/index.js', 'public/js/blog')
    .js('resources/js/blog/show.js', 'public/js/blog')

    .js('resources/js/route/index.js', 'public/js/route')
    .js('resources/js/route/show.js', 'public/js/route')
    .js('resources/js/route/map.js', 'public/js/route')

    .js('resources/js/download/index.js', 'public/js/download')
    .js('resources/js/download/mesh.js', 'public/js/download')

    .js('resources/js/tutoriel/index.js', 'public/js/tutoriel')
    .js('resources/js/tutoriel/list.js', 'public/js/tutoriel')
    .js('resources/js/tutoriel/show.js', 'public/js/tutoriel')

    .js('resources/js/wiki/index.js', 'public/js/wiki')
    .js('resources/js/wiki/show.js', 'public/js/wiki')

    .js('resources/js/auth/login.js', 'public/js/auth')

    .js('resources/js/account/index.js', 'public/js/account')
    .js('resources/js/account/account.js', 'public/js/account')
    .js('resources/js/account/premium.js', 'public/js/account')
    .js('resources/js/account/invoice.js', 'public/js/account')

    .js('resources/js/admin/index.js', 'public/js/admin')


    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/route.scss', 'public/css')
    .sass('resources/sass/download.scss', 'public/css')
    .sass('resources/sass/tutoriel.scss', 'public/css')
    .sass('resources/sass/blog.scss', 'public/css');

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
