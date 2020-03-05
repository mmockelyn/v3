<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {dossier} {class}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Créer une classe Repository';


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
        if(empty($this->argument('dossier'))){
            $namespace = "namespace App\Repository;";
        }else{
            $namespace = "namespace App\Repository\\".$this->argument('dossier').";";
        }

        $class = $this->argument('class');

        $dossierOutput = app_path()."/Repository/".$this->argument('dossier');

        $content = "<?php
$namespace

class $class
{
    /**
     * $class constructor.
     */

    public function __construct()
    {
    }

}

        ";

        $this->isDir($dossierOutput);
        $stat = file_put_contents($dossierOutput."/".$class.".php", $content);
        if($stat == false){
            $this->error('Impossible de créer le fichier');
        }else{
            $this->info("Fichier répertoire Créer");
        }
    }

    private function isDir($dossier){
        if(!is_dir($dossier)){
            mkdir($dossier);
        }
    }
}
