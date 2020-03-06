@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item kt-bg-light" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $asset->designation }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.Objet.index') }}" class="kt-subheader__breadcrumbs-link">Objet </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ $asset->designation }}</span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.Objet.Objet.index') }}" class="btn btn-sm btn-default"><i
                            class="la la-arrow-circle-left"></i> Retour</a>
                    @if($asset->published == 0)
                        <a href="{{ route('Back.Objet.Objet.edit', $asset->id) }}"
                           class="btn btn-sm btn-outline-info"><i class="la la-edit"></i> Editer</a>
                        <a href="{{ route('Back.Objet.Objet.delete', $asset->id) }}"
                           class="btn btn-sm btn-outline-danger"><i class="la la-trash"></i> Supprimer</a>
                        <button class="btn btn-sm btn-icon btn-outline-success" data-toggle="kt-tooltip"
                                title="Publier l'objet"><i class="la la-check"></i></button>
                    @else
                        <button class="btn btn-sm btn-icon btn-outline-danger" data-toggle="kt-tooltip"
                                title="Dépublier l'objet"><i class="la la-times"></i></button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div id="asset" data-id="{{ $asset->id }}"></div>
    <div class="row">
        <div class="col-md-4">
            <div
                class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--height-fluid">
                <div class="kt-portlet__head kt-portlet__space-x">

                </div>
                <div class="kt-portlet__body">
                    <div class="kt-widget27">
                        <div class="kt-widget27__visual">
                            @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('download/'.$asset->id.'.png') == true)
                                <img src="/storage/download/{{ $asset->id }}.png" alt="">
                            @else
                                <img src="/storage/download/download.png" alt="">
                            @endif
                            <div class="kt-widget27__btn">
                                <a href="{{ route('Front.Download.show', [$asset->category->id, $asset->subcategory->id, $asset->id]) }}"
                                   class="btn btn-pill btn-light btn-elevate btn-bold">Voir sur le frontend</a>
                            </div>
                        </div>
                        <div id="asset_block" class="kt-widget27__container kt-portlet__space-x">
                            <div class="text-center mb-5">
                                <h3 id="asset_title" class="kt-font-bold"></h3>
                            </div>
                            <table class="table">
                                <tr>
                                    <td class="kt-font-bold">Catégorie:</td>
                                    <td id="asset_category" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Kuid:</td>
                                    <td id="asset_kuid" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Publier:</td>
                                    <td id="asset_publish" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Prix:</td>
                                    <td id="asset_price" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">Nombre de téléchargement:</td>
                                    <td id="asset_downloaded" class="text-right"></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <span id="asset_social" class="iconify" data-inline="false"
                                              data-icon="brandico:facebook-rect" style="font-size: 39px;"></span>
                                        <span id="asset_mesh" class="iconify" data-inline="false"
                                              data-icon="mdi:video-3d" style="font-size: 39px;"></span>
                                        <span id="asset_config" class="iconify" data-inline="false"
                                              data-icon="ant-design:setting-filled" style="font-size: 39px;"></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="kt-portlet kt-portlet--tabs">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-toolbar">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#description" role="tab">
                                    <i class="la la-file"></i> Description
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#compatibilite" role="tab">
                                    <i class="la la-code-fork"></i> Compatibilité
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tags" role="tab">
                                    <i class="la la-tags"></i> Tags
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="description" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    {!! $asset->description !!}
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="compatibilite" role="tabpanel">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Liste des compatibilités
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-actions">
                                            <button class="btn btn-sm btn-outline-info"><i class="la la-plus"></i>
                                                Nouvelle compatibilité
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 80%">Version</th>
                                            <th style="width: 20%">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($asset->compatibilities as $compatibility)
                                            <tr>
                                                <td>
                                                        <span
                                                            class="kt-media kt-media--circle kt-media--{{ \App\HelpersClass\Asset\AssetHelper::stateClassCompatibility($compatibility->state) }} kt-margin-r-5 kt-margin-t-5">
                                                            <span>{{ $compatibility->trainzBuild->build }}</span>
                                                        </span>
                                                </td>
                                                <td class="text-center">
                                                    <button id="btnDeleteCompatibility"
                                                            data-id="{{ $compatibility->id }}"
                                                            class="btn btn-icon btn-danger"><i class="la la-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tags" role="tabpanel">
                            <div class="kt-portlet">
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">
                                            Liste des tags
                                        </h3>
                                    </div>
                                    <div class="kt-portlet__head-toolbar">
                                        <div class="kt-portlet__head-actions">
                                            <button class="btn btn-sm btn-outline-info"><i class="la la-plus"></i>
                                                Nouveau tag
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="kt-portlet__body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 80%">Tag</th>
                                            <th style="width: 20%">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($asset->tags as $tag)
                                            <tr>
                                                <td>
                                                    <span>{{ $tag->name }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <button id="btnDeleteTag" data-id="{{ $tag->id }}"
                                                            class="btn btn-icon btn-danger"><i class="la la-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/objet/objet/show.js') }}"></script>
@endsection
