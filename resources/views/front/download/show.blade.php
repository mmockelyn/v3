<?php
use App\HelpersClass\Asset\AssetHelper;
?>
@extends("layout.front")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/download.css') }}">
@endsection

@section("subheader")
@endsection

@section("content")
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="tz-blog">
                @if(\Illuminate\Support\Facades\Storage::disk('public')->exists('download/'.$asset->id.'.png') == true)
                    <div class="tz-blog__head__img" style="background-image: url(/storage/download/{{ $asset->id }}.png)">
                        @else
                            <div class="tz-blog__head__img" style="background-image: url(/storage/download/download.png)">
                                @endif
                            </div>
                            <div class="tz-download__subhead">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if($asset->mesh == 1)
                                            <a href="{{ route('Front.Download.mesh', [$asset->asset_category_id, $asset->asset_sub_category_id, $asset->id]) }}" class="btn btn-icon btn-default">
                                                <span class="iconify" data-inline="false" data-icon="cil:3d" style="font-size: 30px; color: white;"></span>
                                            </a>
                                        @endif
                                        @if($asset->config == 1)
                                            <a href="{{ route('Front.Download.config', [$asset->asset_category_id, $asset->asset_sub_category_id, $asset->id]) }}" class="btn btn-icon btn-default">
                                                <span class="iconify" data-inline="false" data-icon="bx:bx-file" style="font-size: 30px; color: white;"></span>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-md-6 text-right">
                                        @if($asset->pricing == 1)
                                            <a href="" class="btn btn-danger">
                                                <span class="iconify" data-inline="false" data-icon="el:shopping-cart-sign" style="font-size: 30px; color: white;"></span> Acheter {{ $asset->price }}
                                            </a>
                                        @else
                                            <a href="{{ route('Front.Download.download', [$asset->asset_category_id, $asset->asset_sub_category_id, $asset->id]) }}" class="btn btn-success">
                                                <span class="iconify" data-inline="false" data-icon="whh:circledownload" style="font-size: 30px; color: white;"></span> Télécharger
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
        <h1 class="title">{{ $asset->category->name }} - {{ $asset->subcategory->name }}</h1>
        <div class="kt-portlet mt-lg-5 mb-lg-3">
            <div class="kt-portlet__body">
                {!! $asset->description !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-5">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Information
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table style="width: 100%">
                            <tbody>
                            <tr>
                                <td class="kt-font-bold">KUID</td>
                                <td class="text-right">{{ $asset->kuid }}</td>
                            </tr>
                            <tr>
                                <td class="kt-font-bold">Date de Création</td>
                                <td class="text-right">{{ $asset->created_at->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td class="kt-font-bold">Date de mise à jour</td>
                                <td class="text-right">{{ $asset->updated_at->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td class="kt-font-bold">Téléchargement</td>
                                <td class="text-right">{{ $asset->countDownload }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                Compatibilité
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="text-center">
                            @foreach($asset->compatibilities as $compatibility)
                                <span
                                    class="badge badge-<?= AssetHelper::stateClassCompatibility($compatibility->state); ?>"
                                    data-toggle="kt-tooltip"
                                    title="<?= $compatibility->trainzbuild->trainz_version_name ?>"><?= $compatibility->trainzbuild->build; ?></span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section("script")
            <script src="{{ asset('js/download/index.js') }}"></script>
@endsection
