<?php

namespace App\Jobs\Objet;

use App\HelpersClass\Core\ZipFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ExtractFbxFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $file;
    public $asset_id;

    /**
     * Create a new job instance.
     *
     * @param $file // Directory du fichier
     * @param $asset_id
     */
    public function __construct($file, $asset_id)
    {
        //
        $this->file = $file;
        $this->asset_id = $asset_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws FileNotFoundException
     */
    public function handle()
    {
        ZipFile::fileFbx(Storage::disk('sftp')->get($this->file), $this->asset_id);
    }
}
