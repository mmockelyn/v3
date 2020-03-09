<?php

namespace App\Repository\Stat;

use App\Model\State\StateVideo;
use Illuminate\Support\Carbon;

class StatVideoRepository
{
    /**
     * @var StateVideo
     */
    private $stateVideo;

    /**
     * StatVideoRepository constructor.
     * @param StateVideo $stateVideo
     */

    public function __construct(StateVideo $stateVideo)
    {
        $this->stateVideo = $stateVideo;
    }

    public function loadViewToday($startHour, $endHour)
    {
        return $this->stateVideo->newQuery()
            ->whereBetween('created_at', [Carbon::createFromTimestamp(strtotime(now()->setHour($startHour))), Carbon::createFromTimestamp(strtotime(now()->setHour($endHour)))])
            ->count();
    }

    public function loadViewMonthly($day)
    {
        return $this->stateVideo->newQuery()
            ->where('created_at', Carbon::createFromTimestamp(strtotime(now()->setDay($day))))
            ->count();
    }

}

