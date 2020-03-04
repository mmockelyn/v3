<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install {--env=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installation du site || --env: local,testing,production';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bar = $this->output->createProgressBar(10);
        $bar->start();
        $this->downSite();
        $bar->advance();
        $this->createEnvFile();
        $bar->advance();
        $this->generateKey();
        $bar->advance();
        $this->accessDirectory();
        $bar->advance();
        $this->migration();
        $bar->advance();
        $this->npmUpdate();
        $bar->advance();
        $this->npmAsset();
        $bar->advance();
        $this->launchHorizon();
        $bar->advance();
        $this->launchEchoServer();
        $bar->advance();
        $this->upSite();
        $bar->advance();
        $bar->finish();
        $this->line("Installation du site trainznation effectuée");

        return null;
    }

    private function downSite()
    {
        $this->line("Mise en maintenance du site");
        $this->line("###############################################");
        $this->call('down');
    }

    private function createEnvFile()
    {
        $env = $this->option('env');
        $this->line("Création du fichier d'environnement");
        $this->line("###############################################");
        switch ($env) {
            case 'local':
                exec('cp .env.local .env');
                break;

            case 'testing':
                exec('cp .env.testing .env');
                break;

            case 'production':
                exec('cp .env.prod .env');
        }
    }

    private function generateKey()
    {
        $this->line("Generation de la clé");
        $this->line("###############################################");
        $this->call('key:generate');
    }

    private function accessDirectory()
    {
        $this->line("Définition des accès aux fichiers");
        $this->line("###############################################");
        exec('chmod -R 777 /storage /bootstrap');
    }

    private function migration()
    {
        $this->line("Migration & Seeding");
        $this->line("###############################################");

        $env = $this->option('env');

        switch ($env) {
            case 'local':
                $this->call('migrate:fresh');
                $this->call('db:seed', [
                    '--class' => "DatabaseSeeder"
                ]);
                break;

            case 'testing':
                $this->call('migrate');
                $this->call('db:seed', [
                    '--class' => "DatabaseSeeder"
                ]);
                break;

            case 'production':
                $this->call('migrate');
                $this->call('db:seed', [
                    '--class' => "ProductionSeeder"
                ]);
        }
    }

    private function npmUpdate()
    {
        $this->line("Mise à jour NPM");
        $this->line("###############################################");
        exec("npm install");
    }

    private function npmAsset()
    {
        $this->line("Build Assets With NPM");
        $this->line("###############################################");
        exec('npm run production');
    }

    private function launchHorizon()
    {
        $this->line("Lancement d'horizon");
        $this->line("###############################################");
        exec('screen -S trainznation_horizon -m php artisan horizon');
    }

    private function launchEchoServer()
    {
        $this->line("Lancement de Laravel Echo Server");
        $this->line("###############################################");
        exec('screen -S trainznation_echo -m laravel-echo-server start');
    }

    private function upSite() {
        $this->line("Sortie du mode maintenance");
        $this->line("###############################################");
        $this->call('up');
    }


}
