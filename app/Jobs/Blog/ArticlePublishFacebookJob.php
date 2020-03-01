<?php

namespace App\Jobs\Blog;

use App\Notifications\Blog\ArticlePublishFacebook;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ArticlePublishFacebookJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var
     */
    public $blog;

    /**
     * Create a new job instance.
     *
     * @param $blog
     */
    public function __construct($blog)
    {
        //
        $this->blog = $blog;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->blog->notify(new ArticlePublishFacebook($this->blog));
    }
}
