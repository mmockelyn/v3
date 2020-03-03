<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trainz:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nettoyage complet';

    /**
     * Create a new command instance.
     *
     * @return void
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
        exec('composer dumpautoload');
        $this->call('clear');
        $this->call('view:clear');
        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('route:clear');
    }
}
