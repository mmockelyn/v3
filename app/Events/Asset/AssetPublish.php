<?php

namespace App\Events\Asset;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AssetPublish implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $asset;

    /**
     * Create a new event instance.
     *
     * @param $asset
     */
    public function __construct($asset)
    {
        //
        $this->asset = $asset;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('trainznation');
    }

    public function broadcastWith()
    {
        return ["title" => $this->asset->designation, "short_content" => $this->asset->short_description];
    }
}
