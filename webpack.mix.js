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
    .js('resources/js/download/config.js', 'public/js/download')

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

    .js('resources/js/admin/blog/index.js', 'public/js/admin/blog')
    .js('resources/js/admin/blog/category/index.js', 'public/js/admin/blog/category')
    .js('resources/js/admin/blog/article/index.js', 'public/js/admin/blog/article')
    .js('resources/js/admin/blog/article/show.js', 'public/js/admin/blog/article')
    .js('resources/js/admin/blog/article/edit.js', 'public/js/admin/blog/article')

    .js('resources/js/admin/route/index.js', 'public/js/admin/route')
    .js('resources/js/admin/route/show.js', 'public/js/admin/route')
    .js('resources/js/admin/route/version.js', 'public/js/admin/route')
    .js('resources/js/admin/route/gallery.js', 'public/js/admin/route')
    .js('resources/js/admin/route/lab.js', 'public/js/admin/route')
    .js('resources/js/admin/route/lab_edit.js', 'public/js/admin/route')
    .js('resources/js/admin/route/download.js', 'public/js/admin/route')
    .js('resources/js/admin/route/config.js', 'public/js/admin/route')

    .js('resources/js/admin/objet/index.js', 'public/js/admin/objet')
    .js('resources/js/admin/objet/category/index.js', 'public/js/admin/objet/category')
    .js('resources/js/admin/objet/objet/index.js', 'public/js/admin/objet/objet')
    .js('resources/js/admin/objet/objet/show.js', 'public/js/admin/objet/objet')
    .js('resources/js/admin/objet/objet/edit.js', 'public/js/admin/objet/objet')

    .js('resources/js/admin/tutoriel/index.js', 'public/js/admin/tutoriel')
    .js('resources/js/admin/tutoriel/category/index.js', 'public/js/admin/tutoriel/category')
    .js('resources/js/admin/tutoriel/video/index.js', 'public/js/admin/tutoriel/video')
    .js('resources/js/admin/tutoriel/video/edit.js', 'public/js/admin/tutoriel/video')
    .js('resources/js/admin/tutoriel/video/show.js', 'public/js/admin/tutoriel/video')

    .js('resources/js/admin/wiki/index.js', 'public/js/admin/wiki')
    .js('resources/js/admin/wiki/category/index.js', 'public/js/admin/wiki/category')
    .js('resources/js/admin/wiki/article/index.js', 'public/js/admin/wiki/article')
    .js('resources/js/admin/wiki/article/edit.js', 'public/js/admin/wiki/article')
    .js('resources/js/admin/wiki/article/show.js', 'public/js/admin/wiki/article')

    .js('resources/js/admin/user/index.js', 'public/js/admin/user')
    .js('resources/js/admin/user/gestion/index.js', 'public/js/admin/user/gestion')
    .js('resources/js/admin/user/gestion/edit.js', 'public/js/admin/user/gestion')
    .js('resources/js/admin/user/gestion/show.js', 'public/js/admin/user/gestion')

    .js('resources/js/admin/slideshow/index.js', 'public/js/admin/slideshow')


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
