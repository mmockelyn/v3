@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    {{ $user->name }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.User.index') }}" class="kt-subheader__breadcrumbs-link">Utilisateurs </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ $user->name }} </span>
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Back.User.Gestion.index') }}" class="btn btn-default"><i
                            class="la la-arrow-circle-left"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__body">
            <div class="kt-widget kt-widget--user-profile-3">
                <div class="kt-widget__top">
                    @if(\Thomaswelton\LaravelGravatar\Facades\Gravatar::exists($user->email) == true)
                        <div class="kt-widget__media">
                            <img src="{{ \Thomaswelton\LaravelGravatar\Facades\Gravatar::src($user->email) }}"
                                 alt="image">
                        </div>
                    @else
                        <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
                            {{ \App\HelpersClass\Generator::firsLetter($user->name, 2) }}
                        </div>
                    @endif
                    <div class="kt-widget__content">
                        <div class="kt-widget__head">
                            <a href="#" class="kt-widget__username">
                                {{ $user->name }}
                                @if($user->state == 0)
                                    <i class="flaticon2-cross kt-font-danger" data-toggle="kt-tooltip"
                                       title="Bloqué"></i>
                                @else
                                    <i class="flaticon2-correct" data-toggle="kt-tooltip" title="Actif"></i>
                                @endif
                                @if($user->premium->premium == 1)
                                    <i class="fa fa-certificate kt-font-warning" data-toggle="kt-tooltip"
                                       title="Premium (Fin {{ $user->premium->premium_end->diffForHumans() }})"></i>
                                @endif
                            </a>

                            <div class="kt-widget__action">
                                <button type="button" class="btn btn-label-success btn-sm btn-upper">ask</button>&nbsp;
                                <button type="button" class="btn btn-brand btn-sm btn-upper">hire</button>
                            </div>
                        </div>

                        <div class="kt-widget__subhead">
                            <a href="#"><i class="flaticon2-new-email"></i>{{ $user->email }}</a>
                        </div>

                        <div class="kt-widget__info">
                            <div class="kt-widget__desc">
                                @if($user->social->discord_id != null)
                                    <a class="btn btn-icon btn-elevate btn-circle"><i class="socicon-discord"></i> </a>
                                @else
                                    <a class="btn btn-icon btn-elevate btn-circle" disabled><i
                                            class="socicon-discord"></i> </a>
                                @endif
                                @if($user->social->pseudo_google != null)
                                    <a class="btn btn-icon btn-elevate btn-circle btn-google"><i
                                            class="socicon-google"></i> </a>
                                @else
                                    <a class="btn btn-icon btn-elevate btn-circle" disabled><i
                                            class="socicon-google"></i> </a>
                                @endif
                                @if($user->social->pseudo_microsoft != null)
                                    <a class="btn btn-icon btn-elevate btn-circle"><i class="socicon-windows"></i> </a>
                                @else
                                    <a class="btn btn-icon btn-elevate btn-circle" disabled><i
                                            class="socicon-windows"></i> </a>
                                @endif
                                @if($user->social->pseudo_twitch != null)
                                    <a class="btn btn-icon btn-elevate btn-circle"><i class="socicon-twitch"></i> </a>
                                @else
                                    <a class="btn btn-icon btn-elevate btn-circle" disabled><i
                                            class="socicon-twitch"></i> </a>
                                @endif
                                @if($user->social->pseudo_youtube != null)
                                    <a class="btn btn-icon btn-elevate btn-circle btn-youtube"><i
                                            class="socicon-youtube"></i> </a>
                                @else
                                    <a class="btn btn-icon btn-elevate btn-circle" disabled><i
                                            class="socicon-youtube"></i> </a>
                                @endif
                                @if($user->social->pseudo_trainz != null)
                                    <a class="btn btn-icon btn-elevate btn-circle">
                                        <img src="/storage/other/logo_trainz_seul.png" width="13" alt="">
                                    </a>
                                @else
                                    <a class="btn btn-icon btn-elevate btn-circle" disabled>
                                        <img src="/storage/other/logo_trainz_seul.png" width="13" alt="">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-toolbar">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-success" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#activity" role="tab">
                            <i class="la la-bell"></i> Activité
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#contrib" role="tab">
                            <i class="la la-commenting"></i> Contribution
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#payments" role="tab">
                            <i class="la la-credit-card"></i> Mode de Paiements
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#invoices" role="tab">
                            <i class="la la-euro"></i> Factures
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#config" role="tab">
                            <i class="la la-cogs"></i> Configuration
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="tab-content">
                <div class="tab-pane active" id="activity" role="tabpanel">
                    <div class="kt-portlet kt-portlet--mobile">
                        <div class="kt-portlet__head kt-portlet__head--lg">
                            <div class="kt-portlet__head-label">
								<span class="kt-portlet__head-icon">
									<i class="kt-font-brand flaticon2-bell"></i>
								</span>
                                <h3 class="kt-portlet__head-title">
                                    Activités de l'utilisateur
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            @if(count($user->activities) == 0)
                                <h3 class="text-center"><i class="la la-warning kt-font-warning la-3x"></i> Aucune
                                    activité</h3>
                            @else
                                <div class="kt-list-timeline">
                                    <div class="kt-list-timeline__items">
                                        @foreach($user->activities as $activity)
                                            <div class="kt-list-timeline__item">
                                                <span
                                                    class="kt-list-timeline__badge kt-list-timeline__badge--{{ \App\HelpersClass\Account\AccountActivityHelper::stateActivity($activity->state) }}"></span>
                                                <span class="kt-list-timeline__text">{{ $activity->description }}</span>
                                                <span
                                                    class="kt-list-timeline__time">{{ $activity->created_at->diffForHumans() }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="contrib" role="tabpanel">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand la la-newspaper-o"></i>
										</span>
                                        <h3 class="kt-portlet__head-title">
                                            Commentaire sur les articles de blog
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body kt-portlet__body--fit">
                                    <!--begin: Datatable -->
                                    <div class="kt-datatable" id="listeContribBlog"></div>
                                    <!--end: Datatable -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="kt-portlet kt-portlet--mobile">
                                <div class="kt-portlet__head kt-portlet__head--lg">
                                    <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand la la-youtube-play"></i>
										</span>
                                        <h3 class="kt-portlet__head-title">
                                            Commentaire sur les articles de tutoriel
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body kt-portlet__body--fit">
                                    <!--begin: Datatable -->
                                    <div class="kt-datatable" id="listeContribTutoriel"></div>
                                    <!--end: Datatable -->
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
    <script src="{{ asset('js/admin/user/gestion/show.js') }}"></script>
@endsection
