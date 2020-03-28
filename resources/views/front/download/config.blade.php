@extends("layout.front")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/download.css') }}">
@endsection

@section("subheader")
@endsection

@section("content")
    <div class="kt-portlet" id="asset" data-id="{{ $asset->id }}">
        <div class="kt-portlet__body">
            <div class="tz-blog">
                @if(file_exists('/storage/download/'.$asset->id.'.png'))
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
                                <a href="{{ redirect()->back() }}" class="btn btn-primary">
                                    <span class="iconify" data-inline="false" data-icon="fe:arrow-left" style="font-size: 30px; color: white;"></span> Retour
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h1 class="title">{{ $asset->category->name }} - {{ $asset->subcategory->name }} - Fichier de configuration</h1>
        <div class="kt-portlet mt-lg-5 mb-lg-3">
            <div class="kt-portlet__body" id="config">
            </div>
        </div>
@endsection

@section("script")
    <script src="{{ asset('js/download/index.js') }}"></script>
    <script src="{{ asset('js/download/config.js') }}"></script>
@endsection
