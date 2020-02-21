<?php
namespace App\Repository\Core;

use App\Model\Core\Slideshow;

class SlideshowRepository
{
    /**
     * @var Slideshow
     */
    private $slideshow;

    /**
     * SlideshowRepository constructor.
     * @param Slideshow $slideshow
     */

    public function __construct(Slideshow $slideshow)
    {
        $this->slideshow = $slideshow;
    }

    public function getLatest()
    {
        return $this->slideshow->newQuery()
            ->limit(5)
            ->get();
    }

}

