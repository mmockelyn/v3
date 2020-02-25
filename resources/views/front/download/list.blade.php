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
                <div class="tz-blog__head">
                    <div class="row">
                        <div class="col-md-4 tz-blog__icons">
                            <!--<span class="iconify" data-inline="false" data-icon="cil:3d" style="font-size: 230px; color: white;"></span>-->
                            <img src="/storage/download/subcategory/{{ $sub->id }}.png" class="img-fluid" width="230" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="tz-blog__title">{{ $sub->name }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @foreach($sub->assets as $download)
            <a href="" class="card mb-3 mt-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        @if(file_exists('/storage/download/'.$download->id.'.png'))
                        <img src="/storage/download/{{ $download->id }}.png" class="card-img" alt="{{ $download->designation }}">
                        @else
                            <img src="/storage/download/download.png" class="card-img" alt="{{ $download->designation }}">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title">{{ $download->designation }}</h3>
                                    <p class="card-text">{{ $download->short_description }}</p>
                                </div>
                                <div class="col-md-2">
                                    @if($download->pricing == 0)
                                        <span class="kt-font-bolder">GRATUIT</span>
                                    @else
                                        <span class="kt-font-bolder">{{ $download->price }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="text-muted"><i class="la la-download"></i> {{ $download->countDownload }}</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        @foreach($download->compatibilities as $compatibility)
                                            <span class="badge badge-pill badge-<?= \App\HelpersClass\Asset\AssetHelper::stateClassCompatibility($compatibility->state); ?>" data-toggle="kt-tooltip" title="<?= $compatibility->trainzbuild->trainz_version_name ?>"><?= $compatibility->trainzbuild->build; ?></span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/download/index.js') }}"></script>
@endsection
