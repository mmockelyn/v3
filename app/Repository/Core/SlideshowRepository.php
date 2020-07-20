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

    public function getAll()
    {
        return $this->slideshow->newQuery()
            ->get();
    }

    public function delete($id)
    {
        return $this->slideshow->newQuery()
            ->find($id)
            ->delete();
    }

    public function create(string $linkImages, $linkArticle)
    {
        return $this->slideshow->newQuery()
            ->create([
                "linkImages" => $linkImages,
                "linkArticle" => $linkArticle
            ]);
    }

    public function update($id, string $linkImages, $linkArticle)
    {
        return $this->slideshow->newQuery()
            ->find($id)
            ->update([
                "linkImages" => $linkImages,
                "linkArticle" => $linkArticle
            ]);
    }

}

