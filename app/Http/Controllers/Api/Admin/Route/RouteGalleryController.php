<?php

namespace App\Http\Controllers\Api\Admin\Route;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
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
     * RouteGalleryController constructor.
     * @param RouteGalleryRepository $routeGalleryRepository
     */
    public function __construct(RouteGalleryRepository $routeGalleryRepository)
    {
        $this->routeGalleryRepository = $routeGalleryRepository;
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
                                $this->routeGalleryRepository->create($request->get('cat'), $file->getClientOriginalName());

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
}
