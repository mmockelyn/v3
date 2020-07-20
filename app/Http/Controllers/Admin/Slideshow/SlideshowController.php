<?php

namespace App\Http\Controllers\Admin\Slideshow;

use App\Http\Controllers\Controller;
use App\Repository\Core\SlideshowRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class SlideshowController extends Controller
{
    /**
     * @var SlideshowRepository
     */
    private $slideshowRepository;

    /**
     * SlideshowController constructor.
     * @param SlideshowRepository $slideshowRepository
     */
    public function __construct(SlideshowRepository $slideshowRepository)
    {
        $this->slideshowRepository = $slideshowRepository;
    }

    public function index()
    {
        return view('admin.slideshow.index', [
            "slides" => $this->slideshowRepository->getAll()
        ]);
    }

    public function delete($id)
    {
        try {
            Storage::disk('public')->delete('slideshow/'.$id.'.png');
        }catch (FileException $exception) {
            Log::error("Impossible de supprimer l'images: ".$exception->getMessage());
            return redirect()->back()->with('error', "Erreur lors de la suppression de l'images: ".$exception->getMessage());
        }

        $this->slideshowRepository->delete($id);

        return redirect()->back()->with('success', "Le slide à été supprimer avec succès !");
    }
}
