@extends("layout.front")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endsection

@section("subheader")
@endsection

@section("content")
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="tz-blog">
                <div class="tz-blog__head__img" style="background-image: url(/storage/blog/news.png)"></div>
                <div class="tz-blog__body">
                    <div class="title">{{ $blog->title }}</div>
                    <div class="subtitle">Posté le {{ $blog->published_at->format('d/m/Y à H:i') }}</div>
                    <div class="content">{{ $blog->content }}</div>
                </div>
                <hr>
                <div class="tz-blog__comments">
                    <div class="row" style="margin-bottom: 50px">
                        <div class="col-md-6">
                            <span class="count_comments">{{ \App\HelpersClass\Blog\BlogHelper::countCommentWithArticle($blog->id) }} {{ \App\HelpersClass\Generator::formatPlural('commentaire', \App\HelpersClass\Blog\BlogHelper::countCommentWithArticle($blog->id)) }}</span>
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
                                                    {{ $comment->updated_at->diffForHumans() }}
                                                    </span>
                                                    @if($comment->user->id == auth()->user()->id)
                                                        <button id="btnDeleteComment" data-blogid="{{ $blog->id }}" data-id="{{ $comment->id }}" class="btn btn-sm btn-danger">Supprimer</button>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="kt-widget3__body">
                                                <p class="kt-widget3__text">
                                                    {!! $comment->comment !!}
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
    </div>

    <div class="modal fade" id="modalNewComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="la la-commenting"></i> Nouveau Commentaire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ route('Blog.Comment.post', $blog->id) }}" class="kt-form" id="formAddComment">
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
    <script src="{{ asset('js/blog/show.js') }}"></script>
@endsection
