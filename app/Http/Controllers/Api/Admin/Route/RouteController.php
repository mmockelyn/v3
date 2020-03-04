<?php

namespace App\Http\Controllers\Api\Admin\Route;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Core\GareRepository;
use App\Repository\Route\RouteAnomalieRepository;
use App\Repository\Route\RouteBuildRepository;
use App\Repository\Route\RouteRepository;
use App\Repository\Route\RouteTimelineRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class RouteController extends BaseController
{
    /**
     * @var RouteRepository
     */
    private $routeRepository;
    /**
     * @var GareRepository
     */
    private $gareRepository;
    /**
     * @var RouteTimelineRepository
     */
    private $routeTimelineRepository;
    /**
     * @var RouteBuildRepository
     */
    private $routeBuildRepository;
    /**
     * @var RouteAnomalieRepository
     */
    private $routeAnomalieRepository;

    /**
     * RouteController constructor.
     * @param RouteRepository $routeRepository
     * @param GareRepository $gareRepository
     * @param RouteTimelineRepository $routeTimelineRepository
     * @param RouteBuildRepository $routeBuildRepository
     * @param RouteAnomalieRepository $routeAnomalieRepository
     */
    public function __construct(
        RouteRepository $routeRepository,
        GareRepository $gareRepository,
        RouteTimelineRepository $routeTimelineRepository,
        RouteBuildRepository $routeBuildRepository, RouteAnomalieRepository $routeAnomalieRepository)
    {
        $this->routeRepository = $routeRepository;
        $this->gareRepository = $gareRepository;
        $this->routeTimelineRepository = $routeTimelineRepository;
        $this->routeBuildRepository = $routeBuildRepository;
        $this->routeAnomalieRepository = $routeAnomalieRepository;
    }

    public function list(Request $request)
    {
        if ($request->exists('q')) {
            $datas = $this->routeRepository->allForSearch($request->get('q'));
        } else {
            $datas = $this->routeRepository->all();
        }

        ob_start();
        ?>
        <?php if (count($datas) != 0): ?>
        <div class="row">
            <?php foreach ($datas as $data): ?>
                <div class="col-md-4">
                    <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                        <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                            <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides"
                                 style="min-height: 300px; background-image: url(/storage/route/<?= $data->id; ?>/route.png)">
                                <h3 class="kt-widget19__title kt-font-light">
                                    <?= $data->name; ?>
                                </h3>
                                <div class="kt-widget19__shadow"></div>
                                <div class="kt-widget19__labels">
                                    <?php if ($data->published == 0): ?>
                                        <a href="#" class="btn btn-label-danger btn-bold ">Non Publier</a>
                                    <?php else: ?>
                                        <a href="#" class="btn btn-label-success btn-bold ">Publier</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-widget19__wrapper">
                                <div class="kt-widget19__text">
                                    <?= Str::limit($data->description, '100', '...'); ?>
                                </div>
                            </div>
                            <div class="kt-widget19__action">
                                <a href="<?= route('Back.Route.show', $data->id); ?>" class="btn btn-sm btn-label-brand btn-bold btn-block">En savoir plus...</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="card-title"><i class="la la-warning la-lg kt-font-warning"></i> Aucune route</h1>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Contenue");
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            "name" => "required",
            "description" => "required",
            "images" => "required|file|image"
        ]);

        if($validator->fails()) {
            return redirect()->back();
        }

        try {
            $route = $this->routeRepository->create($request->name, $request->description);

            try {
                $request->file('images')->storeAs('route/'.$route->id, 'route.png', 'public');
                return redirect()->back()->with('success', "La Route ".$route->name." à été créer");
            }catch (FileException $exception) {
                return redirect()->back()->with('error', "Erreur lors du transfère de fichier: ".$exception->getMessage());
            }
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function editDescription(Request $request, $route_id)
    {
        $validator = \Validator::make($request->all(), [
            "description" => "required|min:5"
        ]);

        if($validator->fails()) {
            return $this->sendError("Erreur de validation", [
                "errors" => $validator->errors()->all()
            ], 203);
        }

        try {
            $this->routeRepository->updateDescription($route_id, $request->description);

            return $this->sendResponse("ok", 'ok');
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function publish($route_id)
    {
        try {
            $this->routeRepository->publish($route_id);

            return $this->sendResponse("OK", "ok");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function unpublish($route_id)
    {
        try {
            $this->routeRepository->unpublish($route_id);

            return $this->sendResponse("OK", "ok");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function searchGare(Request $request)
    {
        $data = $this->gareRepository->search($request->get('q'));

        return $this->sendResponse($data, "Search Gare");
    }

    public function nextVersion(Request $request, $route_id)
    {
        // Création du timeline
        $tml = $this->routeTimelineRepository->create(
            $route_id,
            $request->version,
            $request->description
        );

        // Changement de la version du build
        $build = $this->routeBuildRepository->updateVersion($route_id, $request->version);

        // Nettoyage des anomalies résolue
        $anomalies = $this->routeAnomalieRepository->getOnFinished($route_id);
        foreach ($anomalies as $anomaly) {
            $this->routeAnomalieRepository->delete($anomaly->id);
        }

        return $this->sendResponse($build->toArray(), "ok");
    }
}
