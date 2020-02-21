<?php
namespace App\Repository\Core;

use App\Model\Core\TrainzBuild;

class TrainzBuildRepository
{
    /**
     * @var TrainzBuild
     */
    private $trainzBuild;

    /**
     * TrainzBuildRepository constructor.
     * @param TrainzBuild $trainzBuild
     */

    public function __construct(TrainzBuild $trainzBuild)
    {
        $this->trainzBuild = $trainzBuild;
    }

}

