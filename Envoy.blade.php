@setup
$repository = "https://gitlab.com/trainznation/v3.git";
$app_dir = "/var/www/trainznation.ts";
@endsetup

@servers(['web' => '-i C:\Users\Sylth\.ssh\rsa root@192.168.1.26'])

@story('deploy')
down_title
down

pull_change_title
pull_change

composer_title
composer

migrate_title
migrate

npm_title
npm

assets_title
assets

echo_title
echo

up_title
up

terminate_title
@endstory

@task('')
echo ' '
@endtask

@task('down_title')
echo "Mise en maintenance de l'application" >&2
echo "############################################################" >&2
@endtask

@task('down')
@if($down)
    cd {{ $app_dir }}
    php artisan down 2>&1
@else
    echo "SKIP >>"
@endif
@endtask

@task('pull_change_title')
echo "Mise à jours de deploiement dans {{ $app_dir }}" >&2
echo "############################################################" >&2
@endtask

@task('pull_change')
cd {{ $app_dir }}
git pull 2>&1
@endtask

@task('composer_title')
echo "Mise à jours de composer" >&2
echo "############################################################" >&2
@endtask

@task('composer')
@if($composer)
    cd {{ $app_dir }}
    composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader 2>&1
@else
    echo ">> SKIP >>"
@endif
@endtask

@task('migrate_title')
echo "Mise à jours de la base de donnée" >&2
echo "############################################################" >&2
@endtask

@task('migrate')
@if($migrate)
    cd {{ $app_dir }}
    @if($all_migrate_refresh)
        php artisan migrate:fresh 2>&1
    @else
        php artisan migrate 2>&1
    @endif
@else
    echo '>> SKIP >>'
@endif
@endtask

@task('npm_title')
echo "Mise à jours de composant javascript" >&2
echo "############################################################" >&2
@endtask

@task('npm')
@if($npm)
    cd {{ $app_dir }}
    npm install 2>&1
@else
    echo ">> SKIP >>"
@endif
@endtask

@task('assets_title')
echo "Compilation des assets..." >&2
echo "############################################################" >&2
@endtask

@task('assets')
@if($assets)
    cd {{ $app_dir }}
    npm run production 2>&1
@else
    echo ">> SKIP >>"
@endif
@endtask

@task('echo_title')
echo "Lancement de laravel echo server" >&2
echo "############################################################" >&2
@endtask

@task('echo')
@if($echo)
    cd {{ $app_dir }}
    laravel-echo-server start 2>&1
@else
    echo ">> SKIP >>"
@endif
@endtask

@task('up_title')
echo "Sortie du mode maintenance de l'application" >&2
echo "############################################################" >&2
@endtask

@task('up')
@if($down)
    cd {{ $app_dir }}
    php artisan up
@else
    echo ">> SKIP >>"
@endif
@endtask

@finished
@slack('https://hooks.slack.com/services/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', '#trainznation')
@endfinished


