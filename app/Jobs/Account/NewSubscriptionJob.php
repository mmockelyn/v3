<?php

namespace App\Jobs\Account;

use App\Notifications\Account\NewSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewSubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var
     */
    public $subscription;
    /**
     * @var
     */
    public $user;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $subscription
     */
    public function __construct($user, $subscription)
    {
        //
        $this->subscription = $subscription;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->user->notify(new NewSubscription($this->user, $this->subscription));
    }
}
