<?php

namespace App\Http\Controllers\Api\Admin\Route;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Repository\Route\RouteGalleryCategoryRepository;
use App\Repository\Route\RouteGalleryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class RouteGalleryController extends BaseController
{
    /**
     * @var RouteGalleryRepository
     */
    private $routeGalleryRepository;
    /**
     * @var RouteGalleryCategoryRepository
     */
    private $routeGalleryCategoryRepository;

    /**
     * RouteGalleryController constructor.
     * @param RouteGalleryRepository $routeGalleryRepository
     * @param RouteGalleryCategoryRepository $routeGalleryCategoryRepository
     */
    public function __construct(RouteGalleryRepository $routeGalleryRepository, RouteGalleryCategoryRepository $routeGalleryCategoryRepository)
    {
        $this->routeGalleryRepository = $routeGalleryRepository;
        $this->routeGalleryCategoryRepository = $routeGalleryCategoryRepository;
    }

    public function addCategory(Request $request, $route_id)
    {
        try {
            $category = $this->routeGalleryCategoryRepository->create($route_id, $request->get('name'));

            return $this->sendResponse($category, "OK");
        }catch (\Exception $exception) {
            return $this->sendError("Erreur Système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function deleteCategory(Request $request, $route_id)
    {
        try {
            foreach ($request->get('categories') as $category) {
                $galleries = $this->routeGalleryRepository->allFromCategory($route_id, $category);
                foreach ($galleries as $gallery) {
                    Storage::disk('public')->delete('route/'.$route_id.'/gallery/'.$gallery->filename);
                    $this->routeGalleryRepository->delete($gallery->id);
                }

                $this->routeGalleryCategoryRepository->delete($category);
            }

            return null;
        }catch (\Exception $exception) {
            return $this->sendError("Erreur système", [
                "errors" => $exception->getMessage()
            ]);
        }
    }

    public function uploadFile(Request $request, $route_id)
    {
        //dd($request->all());
        try {
            $file = $request->file('file');
            $path = 'route/'.$route_id.'/gallery/';
            if(Storage::disk('public')->exists($path.$file->getClientOriginalName()) == true) {
                try {
                    Storage::disk('public')->delete($path.$file->getClientOriginalName());
                    try {
                        $file->storeAs($path, $file->getClientOriginalName(), 'public');

                        try {
                            Storage::disk('public')->setVisibility($path.$file->getClientOriginalName(), 'public');

                            try {
                                $this->routeGalleryRepository->create($route_id, $request->get('cat'), $file->getClientOriginalName());

                                dd("DONE");
                            }catch (\Exception $exception) {
                                dd("Création en base echoué: ".$exception->getMessage());
                            }

                        }catch (FileException $exception) {
                            dd("Modification de la visibilité du fichier echoué: ".$exception->getMessage());
                        }
                    }catch (FileException $exception) {
                        dd("Transfère du fichier echouée: ".$exception->getMessage());
                    }
                }catch (FileException $exception) {
                    dd("Suppression du fichier impossible: ".$exception->getMessage());
                }

            }else{
                try {
                    $file->storeAs($path, $file->getClientOriginalName(), 'public');

                    try {
                        Storage::disk('public')->setVisibility($path.$file->getClientOriginalName(), 'public');

                        try {
                            $this->routeGalleryRepository->create($route_id, $request->get('cat'), $file->getClientOriginalName());

                            dd("DONE");
                        }catch (\Exception $exception) {
                            dd("Création en base echoué: ".$exception->getMessage());
                        }

                    }catch (FileException $exception) {
                        dd("Modification de la visibilité du fichier echoué: ".$exception->getMessage());
                    }
                }catch (FileException $exception) {
                    dd("Transfère du fichier echouée: ".$exception->getMessage());
                }
            }
        }catch (\Exception $exception) {
            dd("Erreur: ".$exception->getMessage());
        }
    }

    public function deleteGallery($route_id, $gallery_id) {
        try {
            $gallery = $this->routeGalleryRepository->get($gallery_id);
            $this->routeGalleryRepository->delete($gallery_id);

            try {
                Storage::disk('public')->delete('route/'.$route_id.'/gallery/'.$gallery->filename);

                return null;
            }catch (FileException $exception) {
                return $this->sendError("Erreur", [
                    "errors" => $exception->getMessage()
                ]);
            }
        }catch (\Exception $exception) {
            return $this->sendError("Erreur", [
                "errors" => $exception->getMessage()
            ]);
        }
    }
}
