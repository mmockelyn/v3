<?php

namespace App\Console\Commands\Tutoriel;

use App\Model\Tutoriel\Tutoriel;
use App\Notifications\Admin\UpdateVideoNotification;
use App\User;
use Illuminate\Console\Command;

class UpdatePublished extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tutoriel:published';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recherche et met à jours les éléments de tutoriel qui doivent être publier';

    /**
     * Create a new command instance.
     *
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
        $userC = new User;
        $admins = $userC->newQuery()->where('group', 1)->get();
        $tutoriel = new Tutoriel;
        $datas = $tutoriel->newQuery()
            ->where('published', 2)
            ->get();

        $arr = [];
        $count = 0;

        foreach ($datas as $data) {

            if($data->published_at <= now()){
                Tutoriel::find($data->id)
                    ->update(["published" => 1]);

                $arr[] = ["name" => $data->title];
                $count++;
            }
        }

        foreach ($admins as $admin) {
            $admin->notify(new UpdateVideoNotification($arr, $count));
        }

        return null;
    }
}
