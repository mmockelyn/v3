<?php

namespace App\Http\Controllers\Api\Admin\Route;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Route\RouteVersionGareRepository;
use App\Repository\Route\RouteVersionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RouteVersionController extends BaseController
{
    /**
     * @var RouteVersionRepository
     */
    private $versionRepository;
    /**
     * @var RouteVersionGareRepository
     */
    private $routeVersionGareRepository;

    /**
     * RouteVersionController constructor.
     * @param RouteVersionRepository $versionRepository
     * @param RouteVersionGareRepository $routeVersionGareRepository
     */
    public function __construct(RouteVersionRepository $versionRepository, RouteVersionGareRepository $routeVersionGareRepository)
    {
        $this->versionRepository = $versionRepository;
        $this->routeVersionGareRepository = $routeVersionGareRepository;
    }

    public function loadGares(Request $request)
    {
        $params = [
            "dataset" => "referentiel-gares-voyageurs",
            "q" => $request->get('q'),
            "sort" => "gare_alias_libelle_noncontraint",
            "facet" => "gare_agencegc_libelle",
            "facet" => "gare_regionsncf_libelle",
            "facet" => "gare_ug_libelle",
            "facet" => "pltf_departement_libellemin",
            "facet" => "pltf_segmentdrg_libelle",
        ];

        $psm = http_build_query($params);
        $endpoint = 'https://ressources.data.sncf.com/api/records/1.0/search?';

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $endpoint . $psm,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($ch);

        return $response;
    }

    public function store(Request $request, $route_id)
    {
        $validator = \Validator::make($request->all(), [
            "version" => "required|numeric",
            "name" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Erreur de validation", [
                "errors" => $validator->errors()->all()
            ]);
        }

        try {
            $version = $this->versionRepository->create(
                $route_id,
                $request->version,
                $request->name,
                $request->distance,
                $request->depart,
                $request->arrive,
                $request->linkVideo
            );

            return $this->sendResponse($version, "ok");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editDescription(Request $request, $route_id, $version_id)
    {
        $validator = \Validator::make($request->all(), [
            "description" => "required|min:5"
        ]);

        if ($validator->fails()) {
            $this->sendError("Erreur de validation", [
                "errors" => $validator->errors()->all()
            ], 203);
        }

        try {
            $this->versionRepository->updateDescription($version_id, $request->description);

            return $this->sendResponse("ok", "ok");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function editThumbnail(Request $request, $route_id, $version_id)
    {
        try {
            if(Storage::disk('public')->exists('route/'.$route_id.'/'.$version_id.'.png') == true) {
                Storage::disk('public')->delete('route/'.$route_id.'/'.$version_id.'.png');
                $request->file('images')->storeAs('route/'.$route_id, $version_id.'.png', 'public');
                Storage::disk('public')->setVisibility('route/'.$route_id.'/'.$version_id.'.png', 'public');
            }else{
                $request->file('images')->storeAs('route/'.$route_id, $version_id.'.png', 'public');
                Storage::disk('public')->setVisibility('route/'.$route_id.'/'.$version_id.'.png', 'public');
            }
            return redirect()->back()->with('success', "L'image de la version à été mise à jours !");
        }catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function deleteVersion($route_id, $version_id)
    {
        try {
            $this->versionRepository->delete($version_id);

            return redirect()->back()->with('type', 'success')->with('message', 'La version à été supprimer avec succès');
        } catch (\Exception $exception) {
            return redirect()->back()->with('type', 'error')->with('message', $exception->getMessage());
        }
    }

    public function createGare(Request $request, $route_id, $version_id)
    {
        if ($request->exists('ter') == true) {
            $ter = 1;
        } else {
            $ter = 0;
        }
        if ($request->exists('tgv') == true) {
            $tgv = 1;
        } else {
            $tgv = 0;
        }
        if ($request->exists('metro') == true) {
            $metro = 1;
        } else {
            $metro = 0;
        }
        if ($request->exists('bus') == true) {
            $bus = 1;
        } else {
            $bus = 0;
        }
        if ($request->exists('tram') == true) {
            $tram = 1;
        } else {
            $tram = 0;
        }
        try {
            $gare = $this->routeVersionGareRepository->create(
                $version_id,
                $request->name_gare,
                $request->type_gare,
                $request->lat,
                $request->long,
                $ter,
                $tgv,
                $metro,
                $bus,
                $tram
            );

            return $this->sendResponse($gare, "ok");
        } catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function deleteGare($route_id, $version_id, $gare_id)
    {
        $gare = $this->routeVersionGareRepository->get($gare_id);
        try {
            $this->routeVersionGareRepository->delete($gare_id);

            return redirect()->back()->with('type', 'success')->with('message', 'La gare <strong>' . $gare->name_gare . '</strong> à été supprimer avec succès');
        } catch (\Exception $exception) {
            return redirect()->back()->with('type', 'error')->with('message', $exception->getMessage());
        }
    }

}
