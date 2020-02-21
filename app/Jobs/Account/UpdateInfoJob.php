<?php

namespace App\Jobs\Account;

use App\Notifications\Account\UpdateInfoNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateInfoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new UpdateInfoNotification($this->user));
    }
}
