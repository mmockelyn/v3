<?php

namespace App\Jobs\Asset;

use App\Model\Asset\Asset;
use App\Notifications\Asset\AssetPublishFacebook;
use App\Notifications\Asset\AssetPublishTwitter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssetPublishSocialJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Asset
     */
    private $asset;

    /**
     * Create a new job instance.
     *
     * @param Asset $asset
     */
    public function __construct(Asset $asset)
    {
        //
        $this->asset = $asset;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->asset->notify(new AssetPublishTwitter($this->asset));
        $this->asset->notify(new AssetPublishFacebook($this->asset));
    }
}
