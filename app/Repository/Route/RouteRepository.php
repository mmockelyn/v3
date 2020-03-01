<?php
namespace App\Repository\Route;

use App\Model\Route\Route;

class RouteRepository
{
    /**
     * @var Route
     */
    private $route;

    /**
     * RouteRepository constructor.
     * @param Route $route
     */

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function allPaginate()
    {
        return $this->route->newQuery()
            ->where('published', 1)
            ->paginate(4);
    }

    public function get($id)
    {
        return $this->route->newQuery()
            ->find($id);
    }

    public function all()
    {
        return $this->route->newQuery()
            ->get();
    }

    public function allForSearch($get)
    {
        return $this->route->newQuery()
            ->where('name', 'like', '%'.$get.'%')
            ->orWhere('description', 'like', '%'.$get.'%')
            ->get();
    }

    public function create($name,$description)
    {
        return $this->route->newQuery()
            ->create([
                "name" => $name,
                "description" => $description
            ]);
    }

    public function updateDescription($route_id, $description)
    {
        return $this->route->newQuery()
            ->find($route_id)
            ->update([
                "description" => $description
            ]);
    }

    public function publish($route_id)
    {
        return $this->route->newQuery()
            ->find($route_id)
            ->update([
                "published" => 1,
                "updated_at" => now()
            ]);
    }

    public function unpublish($route_id)
    {
        return $this->route->newQuery()
            ->find($route_id)
            ->update([
                "published" => 0,
                "updated_at" => now()
            ]);
    }

}

