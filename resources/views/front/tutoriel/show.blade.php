@extends("layout.front")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutoriel.css') }}">
@endsection

@section("subheader")
@endsection

@section("content")
    <div class="kt-portlet" id="tutorielShow" data-id="{{ $tutoriel->id }}">
        <div class="kt-portlet__body">
            <div class="tz-tutoriel">
                <header class="header header-dark text-center header-mirror" id="js-header">
                    <div class="container">
                        <div class="header_player">
                            @if($tutoriel->published == 2)
                                @auth()
                                    @if(auth()->user()->premium->premium == 1)
                                        <div id="tutorielVideo"></div>
                                    @else
                                        <div id="tutorielCountDown" class="countdown" data-ago="{{ $tutoriel->published_at->timestamp }}"></div>
                                    @endif
                                @else
                                        <div id="tutorielCountDown" class="countdown" data-ago="{{ $tutoriel->published_at->timestamp }}"></div>
                                @endauth
                            @else
                                        <div id="tutorielVideo"></div>
                            @endif
                        </div>
                        <h1 class="title title-multiline">
                            <span>Tutoriel vidéo {{ $tutoriel->subcategory->name }}</span>
                            {{ $tutoriel->title }}
                        </h1>
                        <p class="header_btns">
                            <button id="btnDownloadVideo" data-link="{{ route('Front.Tutoriel.video', [$tutoriel->subcategory->id, $tutoriel->id]) }}" class="btn btn-primary"><i class="la la-youtube-play"></i> Télécharger la vidéo</button>
                            @if($tutoriel->source == 1)
                            <button id="btnDownloadSource" data-link="{{ route('Front.Tutoriel.source', [$tutoriel->subcategory->id, $tutoriel->id]) }}" class="btn btn-primary"><i class="la la-download"></i> Télécharger les sources</button>
                            @endif
                            @if($tutoriel->demo == 1)
                            <a id="btnViewDemo" data-link="{{ $tutoriel->linkDemo }}" class="btn btn-primary"><i class="la la-code"></i> Voir la demo</a>
                            @endif
                        </p>
                    </div>

                </header>
            </div>
        </div>
    </div>
    <div class="kt-portlet mt-lg-7">
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-8">
                    <a href="{{ route('Front.Tutoriel.index') }}">Tutoriel</a> /
                    <a href="{{ route('Front.Tutoriel.list', $tutoriel->subcategory->id) }}">{{ $tutoriel->subcategory->name }}</a> /
                    <span>{{ $tutoriel->title }}</span>
                </div>
                <div class="col-md-4 text-right countdown" data-ago="{{ $tutoriel->published_at->timestamp }}"></div>
            </div>
            <div class="row mt-lg-7">
                <div class="col-md-1" id="tutoriel_share">
                    <a href="#comment" class="share-comment">
                        <span class="iconify" data-inline="false" data-icon="bx:bxs-comment" style="font-size: 24px;"></span>
                    </a>
                    <br>
                    <a href="#" target="_blank" class="share-facebook">
                        <span class="iconify" data-inline="false" data-icon="zmdi:twitter-box" style="font-size: 24px;"></span>
                    </a>
                    <br>
                    <a href="#" target="_blank" class="share-twitter">
                        <span class="iconify" data-inline="false" data-icon="fa-brands:facebook-square" style="font-size: 24px;"></span>
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            {!! $tutoriel->content !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    @auth()
                        <button id="btnWatchLater" class="btn btn-primary"><i class="la la-clock-o"></i> Regarder plus tard</button>
                        <div class="mt-1"></div>
                        <button id="btnWatch" class="btn btn-primary"><i class="la la-eye"></i> Marquer comme vu</button>
                    @endauth

                    <div class="sidebar mt-5">
                        <h2 class="sidebar__title">Technique abordée</h2>
                        <div class="list-group mb-lg-1">
                            @if(count($tutoriel->technologies) !== 0)
                                @foreach($tutoriel->technologies as $technology)
                                    <a class="list-group-item" href="">{{ $technology->name }}</a>
                                @endforeach
                            @else
                                Aucune technique
                            @endif
                        </div>
                        <h2 class="sidebar__title">Prérequis</h2>
                        <div class="list-group">
                            @if(count($tutoriel->requis) !== 0)
                                @foreach($tutoriel->requis as $requi)
                                    <a class="list-group-item" href="">{{ $requi->name }}</a>
                                @endforeach
                            @else
                                Aucun prérequis
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="tz-blog__comments">
                <div class="row" style="margin-bottom: 50px">
                    <div class="col-md-6">
                        <span class="count_comments">{{ \App\HelpersClass\Tutoriel\TutorielHelper::countCommentFromTutoriel($tutoriel->id) }} {{ \App\HelpersClass\Generator::formatPlural('commentaire', \App\HelpersClass\Tutoriel\TutorielHelper::countCommentFromTutoriel($tutoriel->id)) }}</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <button id="btnNewComment" class="btn btn-primary"><i class="la la-commenting"></i> Nouveau Commentaire</button>
                    </div>
                </div>

                <div id="comments">
                    @foreach($comments as $comment)
                        <div class="kt-portlet kt-portlet--height-fluid">
                            <div class="kt-portlet__body">
                                <div class="kt-widget3">
                                    <div class="kt-widget3__item">
                                        <div class="kt-widget3__header" style="justify-content: flex-start">
                                            @if(\Thomaswelton\LaravelGravatar\Facades\Gravatar::exists($comment->user->email))
                                                <div class="kt-widget3__user-img">
                                                    <img class="kt-widget3__img" src="{{ \Thomaswelton\LaravelGravatar\Facades\Gravatar::src($comment->user->email) }}" alt="">
                                                </div>
                                            @else
                                                <span class="kt-media kt-media--circle kt-media--danger kt-margin-r-5 kt-margin-t-5">
                                                <span>{{ \App\HelpersClass\Generator::firsLetter($comment->user->name, 2) }}</span>
                                            </span>
                                            @endif
                                            <div class="kt-widget3__info">
                                                <a href="#" class="kt-widget3__username">
                                                    {{ $comment->user->name }}
                                                </a><br>
                                                <span class="kt-widget3__time">
                                                    {{ $comment->published_at->diffForHumans() }}
                                                    </span>
                                                @if($comment->user->id == auth()->user()->id)
                                                    <button id="btnDeleteComment" data-tutorielid="{{ $tutoriel->id }}" data-id="{{ $comment->id }}" class="btn btn-sm btn-danger">Supprimer</button>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="kt-widget3__body">
                                            <p class="kt-widget3__text">
                                                {!! $comment->content !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalNewComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-commenting"></i> Nouveau Commentaire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ route('Tutoriel.Comment.post', $tutoriel->id) }}" class="kt-form" id="formAddComment">
                    @csrf
                    @include("layout.includes.alert")
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="comment">Commentaire</label>
                            <textarea name="comment" id="comment" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnSubmitComment" class="btn btn-success"><i class="la la-check"></i> Poster le commentaire</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="https://cdn.jwplayer.com/libraries/3BX5M91M.js"></script>
    <script src="{{ asset('js/tutoriel/show.js') }}"></script>
@endsection
