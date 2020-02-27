@extends("layout.front")

@section("style")

@endsection

@section("subheader")
@endsection

@section("content")
    <div class="kt-sc" style="background-image: url('/assets/media/bg/bg-9.jpg')">
        <div class="kt-container ">
            <div class="kt-sc__top">
                <h3 class="kt-sc__title">
                    WIKI | {{ $article->category->name }} | {{ $article->subcategory->name }} | {{ $article->title }}
                </h3>
            </div>
            <div class="kt-sc__bottom">
                <h3 class="kt-sc__heading kt-heading kt-heading--center kt-heading--xxl kt-heading--medium">
                    En quoi pouvons-nous vous aider ?
                </h3>
                <form class="kt-sc__form">
                    <div class="input-group">
                        <div class="input-group-prepend">
													<span class="input-group-text" id="basic-addon1">
														<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
															<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																<rect x="0" y="0" width="24" height="24" />
																<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
															</g>
														</svg> </span>
                        </div>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Posez votre question" aria-describedby="basic-addon1">
                    </div>
                    <div class="card" id="suggestions">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row" data-sticky-container>
        <div class="col-md-3">
            <div class="kt-portlet sticky" data-sticky="true" data-margin-top="120" data-sticky-for="1023" data-sticky-class="kt-sticky">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Sommaire
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3 kt-margin-t-20 kt-margin-b-20 nav nav-tabs" role="tablist">
                        @foreach($article->sommaires as $sommaire)
                        <li class="kt-nav__item">
                            <a class="kt-nav__link" data-toggle="tab" href="#{{ \Illuminate\Support\Str::slug($sommaire->title, '_') }}" role="tab">
                                <span class="kt-nav__link-text">{{ $sommaire->title }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                @foreach($article->contents as $content)
                <div class="tab-pane" id="{{ \Illuminate\Support\Str::slug($content->sommaire->title, '_') }}" role="tabpanel">
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            {!! $content->content !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section("script")
    <script src="{{ asset('js/wiki/index.js') }}"></script>
    <script src="{{ asset('js/wiki/show.js') }}"></script>
@endsection
