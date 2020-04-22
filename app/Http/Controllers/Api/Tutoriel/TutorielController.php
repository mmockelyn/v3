<?php

namespace App\Http\Controllers\Api\Tutoriel;

use App\HelpersClass\Generator;
use App\HelpersClass\Tutoriel\TutorielHelper;
use App\Http\Controllers\Api\BaseController;
use App\Repository\Account\UserViewRepository;
use App\Repository\Tutoriel\TutorielRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TutorielController extends BaseController
{
    /**
     * @var TutorielRepository
     */
    private $tutorielRepository;
    /**
     * @var UserViewRepository
     */
    private $userViewRepository;

    /**
     * TutorielController constructor.
     * @param TutorielRepository $tutorielRepository
     * @param UserViewRepository $userViewRepository
     */
    public function __construct(TutorielRepository $tutorielRepository, UserViewRepository $userViewRepository)
    {
        $this->tutorielRepository = $tutorielRepository;
        $this->userViewRepository = $userViewRepository;
    }

    public function latest()
    {
        $datas = $this->tutorielRepository->allWithLimit(3);
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
        <div class="col-md-4">
            <div class="kt-portlet kt-portlet--height-fluid kt-widget19" id="tutoriel_item">
                <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                    <?php if(Storage::disk('public')->exists('tutoriel/'.$data->id.'/banner.png') == true): ?>
                    <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url(/storage/tutoriel/<?= $data->id ?>/banner.png)">
                    <?php else: ?>
                        <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url(/storage/tutoriel/tutoriel.png)">
                    <?php endif; ?>
                        <h3 class="kt-widget19__title kt-font-light">
                            <?= $data->title; ?>
                        </h3>
                        <div class="kt-widget19__shadow"></div>
                        <div class="kt-widget19__labels">
                            <a href="<?= route('Front.Tutoriel.show', [$data->subcategory->short, $data->id]) ?>" class="btn btn-label-light-o2 btn-bold ">
                                <img src="/storage/tutoriel/categorie/<?= $data->subcategory->short ?>_color.png" alt="" style="width: 30px;"> <?= $data->time; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget19__wrapper">
                        <div class="kt-widget19__content">
                            <div class="kt-widget19__info">
                                <a href="<?= route('Front.Tutoriel.show', [$data->subcategory->short, $data->id]) ?>" class="kt-widget19__username">
                                    Publié le <?= $data->published_at->format('d/m/Y à H:i') ?>
                                </a>
                            </div>
                            <div class="kt-widget19__stats">
                                <span class="kt-widget19__number kt-font-brand">
                                    <i class="la la-comments"></i>
                                </span>
                                <a href="#" class="kt-widget19__comment">
                                    <?= TutorielHelper::countCommentFromTutoriel($data->id) ?> <?= Generator::formatPlural('Commentaire', TutorielHelper::countCommentFromTutoriel($data->id)); ?>
                                </a>
                            </div>
                        </div>
                        <div class="kt-widget19__text">
                            <?= $data->short_content; ?>
                        </div>
                    </div>
                    <div class="kt-widget19__action">
                        <a href="<?= route('Front.Tutoriel.show', [$data->subcategory->id, $data->id]) ?>" class="btn btn-sm btn-label-brand btn-bold">En savoir plus...</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Derniers Tutoriels");
    }

    public function listTutoriel(Request $request, $sub_id)
    {
        if($request->all() == null){
            $datas = $this->tutorielRepository->listForCategory($sub_id);
        }else{
            $datas = $this->tutorielRepository->filterBy($sub_id, $request->filter);
        }
        ob_start();
        ?>
        <?php foreach ($datas as $data): ?>
        <div class="col-md-4">
        <div class="kt-portlet kt-portlet--height-fluid kt-widget19" id="tutoriel_item">
            <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                <?php if(Storage::disk('public')->exists('tutoriel/'.$data->id.'/banner.png') == true): ?>
                <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides <?php if($data->published == 2): ?> tz-tutoriel__countdown <?php endif; ?>" style="min-height: 300px; background-image: url(/storage/tutoriel/<?= $data->id ?>/banner.png)">
                    <?php else: ?>
                    <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides <?php if($data->published == 2): ?> tz-tutoriel__countdown <?php endif; ?>" style="min-height: 300px; background-image: url(/storage/tutoriel/tutoriel.png)">
                        <?php endif; ?>
                        <h3 class="kt-widget19__title kt-font-light">
                            <?= $data->title; ?>
                        </h3>
                        <div class="kt-widget19__shadow"></div>
                        <div class="kt-widget19__labels">
                            <a href="<?= route('Front.Tutoriel.show', [$data->subcategory->short, $data->id]) ?>" class="btn btn-label-light-o2 btn-bold ">
                                <img src="/storage/tutoriel/categorie/<?= $data->subcategory->short ?>_color.png" alt="" style="width: 30px;"> <?= $data->time; ?>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget19__wrapper">
                        <div class="kt-widget19__content">
                            <div class="kt-widget19__info">
                                <a href="<?= route('Front.Tutoriel.show', [$data->subcategory->short, $data->id]) ?>" class="kt-widget19__username">
                                    <?php if($data->published == 2): ?>
                                        Disponible <?= $data->published_at->diffForHumans() ?>
                                    <?php else: ?>
                                        Publié le <?= $data->published_at->format('d/m/Y à H:i') ?>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="kt-widget19__stats">
                                <span class="kt-widget19__number kt-font-brand">
                                    <i class="la la-comments"></i>
                                </span>
                                <a href="#" class="kt-widget19__comment">
                                    <?= TutorielHelper::countCommentFromTutoriel($data->id) ?> <?= Generator::formatPlural('Commentaire', TutorielHelper::countCommentFromTutoriel($data->id)); ?>
                                </a>
                            </div>
                        </div>
                        <div class="kt-widget19__text">
                            <?= $data->short_content; ?>
                        </div>
                    </div>
                    <div class="kt-widget19__action">
                        <a href="<?= route('Front.Tutoriel.show', [$data->subcategory->id, $data->id]) ?>" class="btn btn-sm btn-label-brand btn-bold">En savoir plus...</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
        <?php
        $content = ob_get_clean();

        return $this->sendResponse($content, "Liste des tutoriel");
    }

    public function tutoriel($tutoriel_id)
    {
        $data = $this->tutorielRepository->get($tutoriel_id);

        return $this->sendResponse($data->toArray(), "Tutoriel");
    }

    public function all()
    {
        $tutoriels = $this->tutorielRepository->allForPublish();

        return response()->json($tutoriels->toArray());
    }

}
