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
            <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab"><i class="la la-dashboard"></i> Tableau de Bord</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#account" role="tab"><i class="la la-user-md"></i> Mon Compte</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#contrib" role="tab"><i class="la la-pencil-square"></i> Mes Contributions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#invoice" role="tab"><i class="la la-euro"></i> Mes Factures</a>
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
                                                <img class="kt-widget__img kt-hidden-"
                                                     src="/storage/other/icons/twitter.png" alt="image">
                                            </div>
                                            <div class="kt-widget__content">
                                                <div class="kt-widget__section">
                                                    <a href="#"
                                                       class="kt-widget__username">Twitter @if(!empty(auth()->user()->account->pseudo_twitter))
                                                            ({{ auth()->user()->account->pseudo_twitter }}) @endif</a>
                                                    <div class="kt-widget__button">
                                                        @if(!empty(auth()->user()->account->pseudo_twitter))
                                                            <span class="btn btn-label-success btn-sm">Connecter</span>
                                                        @else
                                                            <span
                                                                class="btn btn-label-danger btn-sm">Non Connecter</span>
                                                        @endif
                                                    </div>

                                                    <div class="kt-widget__action">
                                                        @if(!empty(auth()->user()->account->pseudo_twitter))
                                                            <a href="" id="btnConnect" class="btn btn-label-twitter"
                                                               data-plugin="twitter" data-connect="on">
                                                                @else
                                                                    <a href="/provider/redirect/twitter" id="btnConnect"
                                                                       class="btn btn-label-twitter"
                                                                       data-plugin="twitter" data-connect="off">
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
                                                <img class="kt-widget__img kt-hidden-"
                                                     src="/storage/other/icons/facebook.png" alt="image">
                                            </div>
                                            <div class="kt-widget__content">
                                                <div class="kt-widget__section">
                                                    <a href="#"
                                                       class="kt-widget__username">Facebook @if(!empty(auth()->user()->account->pseudo_facebook))
                                                            ({{ auth()->user()->account->pseudo_facebook }}) @endif</a>
                                                    <div class="kt-widget__button">
                                                        @if(!empty(auth()->user()->account->pseudo_facebook))
                                                            <span class="btn btn-label-success btn-sm">Connecter</span>
                                                        @else
                                                            <span
                                                                class="btn btn-label-danger btn-sm">Non Connecter</span>
                                                        @endif
                                                    </div>

                                                    <div class="kt-widget__action">
                                                        @if(!empty(auth()->user()->account->pseudo_facebook))
                                                            <a href="#" id="btnConnect" class="btn btn-label-facebook"
                                                               data-plugin="facebook" data-connect="on">
                                                                @else
                                                                    <a href="/provider/redirect/facebook"
                                                                       id="btnConnect" class="btn btn-label-facebook"
                                                                       data-plugin="facebook" data-connect="off">
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
                                                <img class="kt-widget__img kt-hidden-"
                                                     src="/storage/other/icons/discord.png" alt="image">
                                            </div>
                                            <div class="kt-widget__content">
                                                <div class="kt-widget__section">
                                                    <a href="#"
                                                       class="kt-widget__username">Discord @if(!empty(auth()->user()->social->pseudo_discord))
                                                            ({{ auth()->user()->social->pseudo_discord }}) @endif</a>
                                                    <div class="kt-widget__button">
                                                        @if(!empty(auth()->user()->social->pseudo_discord))
                                                            <span class="btn btn-label-success btn-sm">Connecter</span>
                                                        @else
                                                            <span
                                                                class="btn btn-label-danger btn-sm">Non Connecter</span>
                                                        @endif
                                                    </div>

                                                    <div class="kt-widget__action">
                                                        @if(!empty(auth()->user()->social->pseudo_discord))
                                                            <a href="#" id="btnConnect" class="btn btn-label-discord"
                                                               data-plugin="discord" data-connect="on">
                                                                @else
                                                                    <a href="/provider/redirect/discord" id="btnConnect"
                                                                       class="btn btn-label-discord"
                                                                       data-plugin="discord" data-connect="off">
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
                            <form id="formEditInfo" action="{{ route('Account.update') }}" class="kt-form"
                                  method="POST">
                                @csrf
                                @include("layout.includes.alert")
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="email">Email <span class="required">*</span></label>
                                        <input type="text" id="email" name="email" class="form-control"
                                               value="{{ auth()->user()->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name">Pseudo <span class="required">*</span></label>
                                        <input type="text" id="name" name="name" class="form-control"
                                               value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="site_web">Site Web</label>
                                        <input type="url" id="site_web" name="site_web" class="form-control"
                                               value="{{ auth()->user()->account->site_web }}"
                                               placeholder="Si vous posséder un site web">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="trainz_id">Identifiant Trainz</label>
                                        <input type="text" id="trainz_id" name="trainz_id" class="form-control"
                                               value="{{ auth()->user()->account->trainz_id }}"
                                               placeholder="Tapez votre identifiant en chiffre">
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
                            <form id="formEditPassword" action="{{ route('Account.updatePass') }}" class="kt-form"
                                  method="POST">
                                @csrf
                                @include("layout.includes.alert")
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <input type="password" id="password" name="password" class="form-control"
                                               placeholder="Nouveau mot de passe">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" id="confirm_password" name="confirm_password"
                                               class="form-control" placeholder="Confirmation du mot de passe">
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

                            <button id="btnTrashAccount" class="btn btn-danger"><i class="flaticon2-trash"></i>
                                Supprimer mon compte
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <h3>Mon Abonnement</h3>
                    <div class="kt-portlet">
                        <div class="kt-portlet__body">
                            @if(auth()->user()->premium->premium == 1)
                                <p>
                                    Votre abonnement expire
                                    <strong>{{ auth()->user()->premium->premium_end->diffForHumans() }}</strong>
                                </p>

                                <button id="btnExtendAbo" class="btn btn-outline-dark"><i class="la la-calendar"></i>
                                    Rallonger mon abonnement
                                </button>

                            @else
                                <p>Vous n'avez actuellement pas souscrit à <strong>Trainznation</strong></p>

                                <button id="btnSubscriptionAbo" class="btn btn-outline-success"><i
                                        class="la la-certificate"></i> Souscrire
                                </button>
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
        <div class="tab-pane" id="contrib" role="tabpanel">
            <div class="row">
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Mes Commentaires (Blog)
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-actions">
                                    <a id="btnReloadContrib" data-action="blog" href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md">
                                        <i class="flaticon2-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body" id="loadContribBlog">

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="kt-portlet">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                    Mes Commentaires (Tutoriel)
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-actions">
                                    <a id="btnReloadContrib" data-action="tutoriel" href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md">
                                        <i class="flaticon2-refresh"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body" id="loadContribTutoriel">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="invoice" role="tabpanel">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-euro"></i>
					</span>
                        <h3 class="kt-portlet__head-title">
                            Liste de mes factures
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-actions">
                            <a id="btnReloadInvoices" href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md">
                                <i class="flaticon2-refresh"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="row align-items-center">
                                    <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                        <div class="kt-input-icon kt-input-icon--left">
                                            <input type="text" class="form-control" placeholder="Rechercher..." id="generalSearch">
                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                <span><i class="la la-search"></i></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Date de la Facture</th>
                            <th>Total de la facture</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="listingInvoices"></tbody>
                    </table>
                </div>
            </div>
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-credit-card"></i>
					</span>
                        <h3 class="kt-portlet__head-title">
                            Liste de mes modes de paiements
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-actions">
                            <a id="btnReloadInvoices" href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md">
                                <i class="flaticon2-refresh"></i>
                            </a>
                            <a data-toggle="modal" href="#addPaymentMethod" class="btn btn-clean btn-sm btn-icon btn-icon-md">
                                <i class="flaticon2-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th>Carte</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="listingModePayments"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addPaymentMethod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout d'un mode de Paiement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="formCreatePaymentMethod" action="{{ route('Account.createMethodPayment') }}" class="kt-form">
                    @csrf
                    @include("layout.includes.alert")
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <input type="text" id="card_number" class="form-control" name="number" placeholder="Numéro de la carte" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="card_exp_month" class="form-control" name="exp_month" required placeholder="MM">
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="card_exp_year" class="form-control" name="exp_year" required placeholder="AA">
                            </div>
                            <div class="col-md-2">
                                <input type="text" id="card_cvc" class="form-control" name="cvc" required placeholder="XXX">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnSubmit" class="btn btn-success">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/account/index.js') }}"></script>
    <script src="{{ asset('js/account/account.js') }}"></script>
@endsection
