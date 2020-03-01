<?php

namespace App\Jobs\Blog;

use App\Notifications\Blog\ArticlePublish;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ArticlePublishJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var
     */
    public $blog;
    /**
     * @var
     */
    public $users;

    /**
     * Create a new job instance.
     *
     * @param $blog
     * @param $users
     */
    public function __construct($blog, $users)
    {
        //
        $this->blog = $blog;
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            $user->notify(new ArticlePublish($this->blog));
        }
    }
}
