<?php
namespace App\Repository\Route;

use App\Model\Route\RouteGallery;

class RouteGalleryRepository
{
    /**
     * @var RouteGallery
     */
    private $routeGallery;

    /**
     * RouteGalleryRepository constructor.
     * @param RouteGallery $routeGallery
     */

    public function __construct(RouteGallery $routeGallery)
    {
        $this->routeGallery = $routeGallery;
    }

    public function allFromRoute($id)
    {
        return $this->routeGallery->newQuery()
            ->where('route_id', $id)
            ->get()
            ->load('category');
    }

    public function allFromCategory($route_id, $category_id)
    {
        return $this->routeGallery->newQuery()
            ->where('route_id', $route_id)
            ->where('route_gallery_category_id', $category_id)
            ->get()
            ->load('category');
    }

    public function create($route_id, $category_id, $filename)
    {
        return $this->routeGallery->newQuery()
            ->create([
                "route_id" => $route_id,
                "route_gallery_category_id" => $category_id,
                "filename" => $filename
            ]);
    }

    public function delete($id)
    {
        return $this->routeGallery->newQuery()
            ->find($id)
            ->delete();
    }

    public function get($gallery_id)
    {
        return $this->routeGallery->newQuery()
            ->find($gallery_id);
    }

}

