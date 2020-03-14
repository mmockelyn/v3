<?php

namespace App\Events\Blog;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PublishArticle implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $article;

    /**
     * Create a new event instance.
     *
     * @param $article
     */
    public function __construct($article)
    {
        $this->article = $article;
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
        return ["title" => $this->article->title, "short_content" => $this->article->short_content];
    }
}
