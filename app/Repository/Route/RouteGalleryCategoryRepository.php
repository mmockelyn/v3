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

    public function allForRoute($route_id)
    {
        return $this->routeGalleryCategory->newQuery()
            ->where('route_id', $route_id)
            ->get();
    }

    public function delete($id)
    {
        return $this->routeGalleryCategory->newQuery()
            ->find($id)
            ->delete();
    }

    public function create($route_id, $get)
    {
        return $this->routeGalleryCategory->newQuery()
            ->create([
                "route_id" => $route_id,
                "name" => $get
            ]);
    }

}

