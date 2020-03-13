<?php

namespace App\Jobs\Tutoriel;

use App\Model\Tutoriel\Tutoriel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PublishLaterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tutoriel_id;

    /**
     * Create a new job instance.
     *
     * @param $tutoriel_id
     */
    public function __construct($tutoriel_id)
    {
        //
        $this->tutoriel_id = $tutoriel_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tutoriel = new Tutoriel();
        $tutoriel->newQuery()->find($this->tutoriel_id)
            ->update([
                "published" => 1,
                "published_at" => now()
            ]);
    }
}
