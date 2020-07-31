<?php
namespace App\Repository\Route;

use App\Model\Route\RouteDownload;
use Webpatser\Uuid\Uuid;

class RouteDownloadRepository
{
    /**
     * @var RouteDownload
     */
    private $routeDownload;

    /**
     * RouteDownloadRepository constructor.
     * @param RouteDownload $routeDownload
     */

    public function __construct(RouteDownload $routeDownload)
    {
        $this->routeDownload = $routeDownload;
    }

    public function getLatesFromRoute($route_id)
    {
        return $this->routeDownload->newQuery()
            ->where('route_id', $route_id)
            ->where('published', 1)
            ->get()
            ->last();
    }

    public function listFromPublish($route_id)
    {
        return $this->routeDownload->newQuery()
            ->where('route_id', $route_id)
            ->where('published', 1)
            ->orderByDesc('updated_at')
            ->get();
    }

    public function getVersion($version_id)
    {
        return $this->routeDownload->newQuery()
            ->find($version_id);
    }

    public function listAllFromRoute($route_id)
    {
        return $this->routeDownload->newQuery()
            ->where('route_id', $route_id)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function create($route_id, $version, $build, $type_download, $type_release, $linkDownload, $note, $published)
    {
        return $this->routeDownload->newQuery()
            ->create([
                "route_id" => $route_id,
                "version" => $version,
                "build" => $build,
                "route_type_download_id" => $type_download,
                "route_type_release_id" => $type_release,
                "linkDownload" => $linkDownload,
                "note" => $note,
                "published" => $published,
                "uuid" => Uuid::generate()
            ]);
    }

    public function getInfoVersion($route_id, $version, $build)
    {
        return $this->routeDownload->newQuery()
            ->where('route_id', $route_id)
            ->where('version', $version)
            ->where('build', $build)
            ->first();
    }

}

