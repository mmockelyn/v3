<?php
namespace App\Repository\Route;

use App\Model\Route\RouteGalleryCategory;

class RouteGalleryCategoryRepository
{
    /**
     * @var RouteGalleryCategory
     */
    private $routeGalleryCategory;

    /**
     * RouteGalleryCategoryRepository constructor.
     * @param RouteGalleryCategory $routeGalleryCategory
     */

    public function __construct(RouteGalleryCategory $routeGalleryCategory)
    {
        $this->routeGalleryCategory = $routeGalleryCategory;
    }

    public function all()
    {
        return $this->routeGalleryCategory->newQuery()
            ->get()
            ->load('galleries');
    }

}

