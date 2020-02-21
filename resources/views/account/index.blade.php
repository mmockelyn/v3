@extends("layout.front")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Mon Compte </h3>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">

                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <ul class="nav nav-tabs nav-fill nav-tabs-line" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab">Tableau de Bord</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#account" role="tab">Mon Compte</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="dashboard" role="tabpanel">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="flaticon-statistics"></i>
                </span>
                        <h3 class="kt-portlet__head-title">
                            Activité récentes
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body" id="latestActivity"></div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="la la-connectdevelop"></i>
                </span>
                        <h3 class="kt-portlet__head-title">
                            Connexion Social
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">

                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body kt-portlet__body--fit-y">
                                    <!--begin::Widget -->
                                    <div class="kt-widget kt-widget--user-profile-4">
                                        <div class="kt-widget__head">
                                            <div class="kt-widget__media">
                                                <img class="kt-widget__img kt-hidden-" src="/storage/other/icons/twitter.png" alt="image">
                                            </div>
                                            <div class="kt-widget__content">
                                                <div class="kt-widget__section">
                                                    <a href="#" class="kt-widget__username">Twitter @if(!empty(auth()->user()->account->pseudo_twitter)) ({{ auth()->user()->account->pseudo_twitter }}) @endif</a>
                                                    <div class="kt-widget__button">
                                                        @if(!empty(auth()->user()->account->pseudo_twitter))
                                                            <span class="btn btn-label-success btn-sm">Connecter</span>
                                                        @else
                                                            <span class="btn btn-label-danger btn-sm">Non Connecter</span>
                                                        @endif
                                                    </div>

                                                    <div class="kt-widget__action">
                                                        @if(!empty(auth()->user()->account->pseudo_twitter))
                                                            <a href="" id="btnConnect" class="btn btn-label-twitter" data-plugin="twitter" data-connect="on">
                                                                @else
                                                                    <a href="/provider/redirect/twitter" id="btnConnect" class="btn btn-label-twitter" data-plugin="twitter" data-connect="off">
                                                                        @endif
                                                                        @if(!empty(auth()->user()->account->pseudo_twitter))
                                                                            <i class="socicon-twitter"></i> Deconnexion
                                                                        @else
                                                                            <i class="socicon-twitter"></i> Connexion
                                                                        @endif
                                                                    </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Widget -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">

                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body kt-portlet__body--fit-y">
                                    <!--begin::Widget -->
                                    <div class="kt-widget kt-widget--user-profile-4">
                                        <div class="kt-widget__head">
                                            <div class="kt-widget__media">
                                                <img class="kt-widget__img kt-hidden-" src="/storage/other/icons/facebook.png" alt="image">
                                            </div>
                                            <div class="kt-widget__content">
                                                <div class="kt-widget__section">
                                                    <a href="#" class="kt-widget__username">Facebook @if(!empty(auth()->user()->account->pseudo_facebook)) ({{ auth()->user()->account->pseudo_facebook }}) @endif</a>
                                                    <div class="kt-widget__button">
                                                        @if(!empty(auth()->user()->account->pseudo_facebook))
                                                            <span class="btn btn-label-success btn-sm">Connecter</span>
                                                        @else
                                                            <span class="btn btn-label-danger btn-sm">Non Connecter</span>
                                                        @endif
                                                    </div>

                                                    <div class="kt-widget__action">
                                                        @if(!empty(auth()->user()->account->pseudo_facebook))
                                                            <a href="#" id="btnConnect" class="btn btn-label-facebook" data-plugin="facebook" data-connect="on">
                                                                @else
                                                                    <a href="/provider/redirect/facebook" id="btnConnect" class="btn btn-label-facebook" data-plugin="facebook" data-connect="off">
                                                                        @endif
                                                                        @if(!empty(auth()->user()->account->pseudo_twitter))
                                                                            <i class="socicon-facebook"></i> Deconnexion
                                                                        @else
                                                                            <i class="socicon-facebook"></i> Connexion
                                                                        @endif
                                                                    </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Widget -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="kt-portlet kt-portlet--height-fluid">
                                <div class="kt-portlet__head kt-portlet__head--noborder">
                                    <div class="kt-portlet__head-label">
                                        <h3 class="kt-portlet__head-title">

                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body kt-portlet__body--fit-y">
                                    <!--begin::Widget -->
                                    <div class="kt-widget kt-widget--user-profile-4">
                                        <div class="kt-widget__head">
                                            <div class="kt-widget__media">
                                                <img class="kt-widget__img kt-hidden-" src="/storage/other/icons/discord.png" alt="image">
                                            </div>
                                            <div class="kt-widget__content">
                                                <div class="kt-widget__section">
                                                    <a href="#" class="kt-widget__username">Discord @if(!empty(auth()->user()->social->pseudo_discord)) ({{ auth()->user()->social->pseudo_discord }}) @endif</a>
                                                    <div class="kt-widget__button">
                                                        @if(!empty(auth()->user()->social->pseudo_discord))
                                                            <span class="btn btn-label-success btn-sm">Connecter</span>
                                                        @else
                                                            <span class="btn btn-label-danger btn-sm">Non Connecter</span>
                                                        @endif
                                                    </div>

                                                    <div class="kt-widget__action">
                                                        @if(!empty(auth()->user()->social->pseudo_discord))
                                                            <a href="#" id="btnConnect" class="btn btn-label-discord" data-plugin="discord" data-connect="on">
                                                                @else
                                                                    <a href="/provider/redirect/discord" id="btnConnect" class="btn btn-label-discord" data-plugin="discord" data-connect="off">
                                                                        @endif
                                                                        @if(!empty(auth()->user()->social->pseudo_discord))
                                                                            <i class="socicon-discord"></i> Deconnexion
                                                                        @else
                                                                            <i class="socicon-discord"></i> Connexion
                                                                        @endif
                                                                    </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Widget -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="account" role="tabpanel">
            <div class="row">
                <div class="col-md-9 col-sm-12">
                    <h2><i class="flaticon2-user-1"></i> Mes Informations</h2>
                    <div class="pt-lg-5"></div>
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            <form id="formEditInfo" action="{{ route('Account.update') }}" class="kt-form" method="POST">
                                @csrf
                                @include("layout.includes.alert")
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="email">Email <span class="required">*</span></label>
                                        <input type="text" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Pseudo <span class="required">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control" value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="site_web">Site Web</label>
                                        <input type="url" id="site_web" name="site_web" class="form-control" value="{{ auth()->user()->account->site_web }}" placeholder="Si vous posséder un site web">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="trainz_id">Identifiant Trainz</label>
                                        <input type="text" id="trainz_id" name="trainz_id" class="form-control" value="{{ auth()->user()->account->trainz_id }}" placeholder="Tapez votre identifiant en chiffre">
                                    </div>
                                </div>
                                <div class="kt-form__actions kt-form__actions--right">
                                    <button type="submit" class="btn btn-success">Modifier mes informations</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h2><i class="flaticon-lock"></i> Mot de Passe</h2>
                    <div class="pt-lg-5"></div>
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            <form id="formEditPassword" action="{{ route('Account.updatePass') }}" class="kt-form" method="POST">
                                @csrf
                                @include("layout.includes.alert")
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Nouveau mot de passe">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirmation du mot de passe">
                                    </div>
                                </div>
                                <div id="feedback"></div>
                                <div class="kt-form__actions kt-form__actions--right">
                                    <button type="submit" class="btn btn-success">Modifier mon mot de passe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h2><i class="flaticon2-trash"></i> Danger Zone</h2>
                    <div class="pt-lg-5"></div>
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            <p>Vous n'êtes pas satisfait du contenu du site ?<br>
                                ou vous souhaitez supprimer toutes les informations associées à ce compte ?</p>

                            <button id="btnTrashAccount" class="btn btn-danger"><i class="flaticon2-trash"></i> Supprimer mon compte</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h3>Mon Abonnement</h3>
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            @if(auth()->user()->premium->premium == 1)
                                <p>
                                    Votre abonnement expire <strong>{{ auth()->user()->premium->premium_end->diffForHumans() }}</strong>
                                </p>

                                <button id="btnExtendAbo" class="btn btn-outline-dark"><i class="la la-calendar"></i> Rallonger mon abonnement</button>

                            @else
                                <p>Vous n'avez actuellement pas souscrit à <strong>Trainznation</strong></p>

                                <button id="btnSubscriptionAbo" class="btn btn-outline-success"><i class="la la-certificate"></i> Souscrire</button>
                            @endif
                        </div>
                    </div>
                    <h3>Factures</h3>
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            <table class="table" id="listLatestInvoice"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/account/index.js') }}"></script>
    <script src="{{ asset('js/account/account.js') }}"></script>
@endsection
