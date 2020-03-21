<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * ClearAllCommand
 *
 * @category ClearAllCommand
 * @package  Syltheron
 * @author   Syltheron <mmockelyn@gmail.com>
 * @license  null GNU General Public License
 * @link     https://gitlab.com/mmockelyn
 */

class ClearAllCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string $signature
     */
    protected $signature = 'trainz:clear';

    /**
     * The console command description.
     *
     * @var string $description
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
        $this->call('clear');
        $this->call('view:clear');
        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('route:clear');
        if (env('APP_ENV') == 'local') {
            $this->call('telescope:clear');
        }
        Storage::deleteDirectory('storage/logs/');
        return null;
    }

}
