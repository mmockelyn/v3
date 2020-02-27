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
        $bar = $this->output->createProgressBar(6);
        $bar->start();
        $this->line("Installation du site Trainznation");
        $this->environnementFile();
        $bar->advance();
        $this->generateKey();
        $bar->advance();
        $this->createDatabase();
        $bar->advance();
        $this->seedingBase();
        $bar->advance();
        $this->startLaravelEchoServer();
        $bar->advance();
        $this->startLaravelHorizon();
        $bar->advance();
        $bar->finish();
        $this->line("Installation du site Trainznation Terminer");
        return null;
    }

    private function environnementFile()
    {
        $env = $this->option('env');
        switch ($env) {
            case 'local':
                exec('cp .env.example .env');
                $this->line("Définition des variables d'environnement Principal");
                Str::replaceFirst('APP_ENV=', 'APP_ENV=local', file_get_contents('.env'));
                Str::replaceFirst('APP_DEBUG=', 'APP_DEBUG=true', file_get_contents('.env'));
                Str::replaceFirst('APP_URL=', 'APP_URL=https://v3.trainznation.io', file_get_contents('.env'));

                $this->line("Définition des variables d'environnement de base de donnée");
                Str::replaceFirst('DB_HOST=', 'DB_HOST=192.168.10.10', file_get_contents('.env'));

                $this->line("Définition des variables d'environnement Redis");
                putenv("REDIS_HOST=127.0.0.1");

                $this->line("Définition des variables d'environnement Mail");
                putenv("MAIL_HOST=192.168.10.10");
                putenv("MAIL_PORT=1025");

                $this->line("Définition des variables d'environnement Terminer");
                break;
            case 'testing':
                exec('cp .env.example .env');
                $this->line("Définition des variables d'environnement Principal");
                putenv("APP_ENV=testing");
                putenv("APP_DEBUG=true");
                putenv("APP_URL=https://v3.trainznation.ts");

                $this->line("Définition des variables d'environnement de base de donnée");
                putenv("DB_HOST=192.168.1.26");
                putenv("DB_DATABASE=v3.trainznation");
                putenv("DB_USERNAME=root");
                putenv("DB_PASSWORD=1992_Maxime");

                $this->line("Définition des variables d'environnement Redis");
                putenv("REDIS_HOST=127.0.0.1");

                $this->line("Définition des variables d'environnement Mail");
                putenv("MAIL_HOST=192.168.1.26");
                putenv("MAIL_PORT=1025");

                $this->line("Définition des variables d'environnement Terminer");
                break;

            case 'production':
                exec('cp .env.example .env');
                $this->line("Définition des variables d'environnement Principal");
                putenv("APP_ENV=production");
                putenv("APP_DEBUG=false");
                putenv("APP_URL=https://trainznation.eu");

                $this->line("Définition des variables d'environnement de base de donnée");
                putenv("DB_HOST=192.168.1.50");
                putenv("DB_DATABASE=trainznation");
                putenv("DB_USERNAME=root");
                putenv("DB_PASSWORD=1992_Maxime");

                $this->line("Définition des variables d'environnement Redis");
                putenv("REDIS_HOST=127.0.0.1");

                $this->line("Définition des variables d'environnement Mail");
                putenv("MAIL_HOST=localhost");
                putenv("MAIL_PORT=25");

                $this->line("Définition des variables d'environnement Terminer");

        }

    }

    private function generateKey()
    {
        $this->line("Déclaration de la clé");
        $this->call('key:generate');
    }

    private function createDatabase()
    {
        $this->line("Création de la base de donnée");
        try {
            $this->call('migrate:fresh');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    private function seedingBase()
    {
        $this->line("Mise en place des données dans la base de donnée:" . env("DB_DATABASE"));
        $env = $this->option('env');
        try {
            switch ($env) {
                case 'local':
                    $this->call('db:seed', [
                        "--class" => "DatabaseSeeder"
                    ]);
                    break;
                case 'testing':
                    $this->call('db:seed', [
                        "--class" => "DatabaseSeeder"
                    ]);
                    break;

                case 'production':
                    $this->call('db:seed', [
                        "--class" => "ProductionSeeder"
                    ]);
            }
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    private function startLaravelEchoServer()
    {
        $this->line("Lancement de Laravel Echo Server");
        try {
            exec('nohup laravel-echo-server start');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    private function startLaravelHorizon()
    {
        $this->line("Lancement de Laravel Horizon");
        try {
            exec('nohup php artisan horizon');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
