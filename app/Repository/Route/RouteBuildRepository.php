<?php
namespace App\Repository\Route;

use App\Model\Route\RouteBuild;

class RouteBuildRepository
{
    /**
     * @var RouteBuild
     */
    private $routeBuild;

    /**
     * RouteBuildRepository constructor.
     * @param RouteBuild $routeBuild
     */

    public function __construct(RouteBuild $routeBuild)
    {
        $this->routeBuild = $routeBuild;
    }

}

