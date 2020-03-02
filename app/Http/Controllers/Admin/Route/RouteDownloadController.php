<?php

namespace App\Http\Controllers\Admin\Route;

use App\Http\Controllers\Controller;
use App\Repository\Route\RouteRepository;
use App\Repository\Route\RouteTypeDownloadRepository;
use App\Repository\Route\RouteTypeReleaseRepository;
use Illuminate\Http\Request;

class RouteDownloadController extends Controller
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;
    /**
     * @var RouteTypeDownloadRepository
     */
    private $routeTypeDownloadRepository;
    /**
     * @var RouteTypeReleaseRepository
     */
    private $routeTypeReleaseRepository;

    /**
     * RouteDownloadController constructor.
     * @param RouteRepository $routeRepository
     * @param RouteTypeDownloadRepository $routeTypeDownloadRepository
     * @param RouteTypeReleaseRepository $routeTypeReleaseRepository
     */
    public function __construct(RouteRepository $routeRepository, RouteTypeDownloadRepository $routeTypeDownloadRepository, RouteTypeReleaseRepository $routeTypeReleaseRepository)
    {
        $this->routeRepository = $routeRepository;
        $this->routeTypeDownloadRepository = $routeTypeDownloadRepository;
        $this->routeTypeReleaseRepository = $routeTypeReleaseRepository;
    }

    public function index($route_id)
    {
        return view('admin.route.download.index', [
            "route" => $this->routeRepository->get($route_id),
            "typeDownloads" => $this->routeTypeDownloadRepository->all(),
            "typeReleases" => $this->routeTypeReleaseRepository->all()
        ]);
    }
}
