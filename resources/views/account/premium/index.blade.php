@extends("layout.front")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Souscription au compte premium </h3>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a id="btnReturn" class="btn btn-dark"><i class="flaticon2-left-arrow"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!--begin::Basic Pricing 4-->
            <div class="kt-pricing-4">
                <div class="kt-pricing-4__top">
                    <div class="kt-pricing-4__top-container kt-pricing-4__top-container--fixed">
                        <div class="kt-pricing-4__top-header">
                            <div class="kt-pricing-4__top-title kt-font-light">
                                <h1>Souscription à l'abonnement PREMIUM</h1>
                            </div>
                        </div>
                        <div class="kt-pricing-4__top-body">

                            <!--begin::Pricing Items-->
                            <div class="kt-pricing-4__top-items">

                                <!--begin::Pricing Item-->
                                <div class="kt-pricing-4__top-item">
                                    <span class="kt-pricing-4__icon kt-font-info">
                                        <i class="fa fa-certificate"></i>
                                    </span>
                                    <h2 class="kt-pricing-4__subtitle">Mensuel</h2>
                                    <span class="kt-pricing-4__price">3,50</span>
                                    <span class="kt-pricing-4__label">€</span>
                                    <div class="kt-pricing-4__btn">
                                        <button type="button" id="btnCheck" class="btn btn-brand btn-upper btn-bold" data-plan="mensuel">Souscrire</button>
                                    </div>

                                    <!--begin::Mobile Pricing Table-->
                                    <div class="kt-pricing-4__top-items-mobile">
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Vidéo des tutoriels</span>
                                            <span><i class="fa fa-check kt-font-success"></i> </span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Sources des tutoriels</span>
                                            <span><i class="fa fa-check kt-font-success"></i></span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Tutoriels en avant première (j-3)</span>
                                            <span><i class="fa fa-check kt-font-success"></i></span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Accès au contenue Payant</span>
                                            <span>(3 Objets)</span>
                                        </div>
                                        <div class="kt-pricing-4__top-btn">
                                            <button type="button" class="btn btn-brand btn-upper btn-bold">Souscrire</button>
                                        </div>
                                    </div>

                                    <!--end::Mobile Pricing Table-->
                                </div>
                                <div class="kt-pricing-4__top-item">
                                    <span class="kt-pricing-4__icon kt-font-info">
                                        <i class="fa fa-certificate"></i>
                                    </span>
                                    <h2 class="kt-pricing-4__subtitle">Trimestriel</h2>
                                    <span class="kt-pricing-4__price">10,00</span>
                                    <span class="kt-pricing-4__label">€</span>
                                    <div class="kt-pricing-4__btn">
                                        <button type="button" id="btnCheck" class="btn btn-brand btn-upper btn-bold" data-plan="trimestriel">Souscrire</button>
                                    </div>

                                    <!--begin::Mobile Pricing Table-->
                                    <div class="kt-pricing-4__top-items-mobile">
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Vidéo des tutoriels</span>
                                            <span><i class="fa fa-check kt-font-success"></i> </span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Sources des tutoriels</span>
                                            <span><i class="fa fa-check kt-font-success"></i></span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Tutoriels en avant première (j-3)</span>
                                            <span><i class="fa fa-check kt-font-success"></i></span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Accès au contenue Payant</span>
                                            <span>(20 Objets)</span>
                                        </div>
                                        <div class="kt-pricing-4__top-btn">
                                            <button type="button" class="btn btn-brand btn-upper btn-bold">Souscrire</button>
                                        </div>
                                    </div>

                                    <!--end::Mobile Pricing Table-->
                                </div>
                                <div class="kt-pricing-4__top-item">
                                    <span class="kt-pricing-4__icon kt-font-info">
                                        <i class="fa fa-certificate"></i>
                                    </span>
                                    <h2 class="kt-pricing-4__subtitle">Semestriel</h2>
                                    <span class="kt-pricing-4__price">19,00</span>
                                    <span class="kt-pricing-4__label">€</span>
                                    <div class="kt-pricing-4__btn">
                                        <button type="button" id="btnCheck" class="btn btn-brand btn-upper btn-bold" data-plan="semestriel">Souscrire</button>
                                    </div>

                                    <!--begin::Mobile Pricing Table-->
                                    <div class="kt-pricing-4__top-items-mobile">
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Vidéo des tutoriels</span>
                                            <span><i class="fa fa-check kt-font-success"></i> </span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Sources des tutoriels</span>
                                            <span><i class="fa fa-check kt-font-success"></i></span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Tutoriels en avant première (j-3)</span>
                                            <span><i class="fa fa-check kt-font-success"></i></span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Accès au contenue Payant</span>
                                            <span>(50 Objets)</span>
                                        </div>
                                        <div class="kt-pricing-4__top-btn">
                                            <button type="button" class="btn btn-brand btn-upper btn-bold">Souscrire</button>
                                        </div>
                                    </div>

                                    <!--end::Mobile Pricing Table-->
                                </div>
                                <div class="kt-pricing-4__top-item">
                                    <span class="kt-pricing-4__icon kt-font-info">
                                        <i class="fa fa-certificate"></i>
                                    </span>
                                    <h2 class="kt-pricing-4__subtitle">Annuel</h2>
                                    <span class="kt-pricing-4__price">35,00</span>
                                    <span class="kt-pricing-4__label">€</span>
                                    <div class="kt-pricing-4__btn">
                                        <button type="button" id="btnCheck" class="btn btn-brand btn-upper btn-bold" data-plan="annuel">Souscrire</button>
                                    </div>

                                    <!--begin::Mobile Pricing Table-->
                                    <div class="kt-pricing-4__top-items-mobile">
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Vidéo des tutoriels</span>
                                            <span><i class="fa fa-check kt-font-success"></i> </span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Sources des tutoriels</span>
                                            <span><i class="fa fa-check kt-font-success"></i></span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Tutoriels en avant première (j-3)</span>
                                            <span><i class="fa fa-check kt-font-success"></i></span>
                                        </div>
                                        <div class="kt-pricing-4__top-item-mobile">
                                            <span>Accès au contenue Payant</span>
                                            <span>(100 Objets)</span>
                                        </div>
                                        <div class="kt-pricing-4__top-btn">
                                            <button type="button" class="btn btn-brand btn-upper btn-bold">Souscrire</button>
                                        </div>
                                    </div>

                                    <!--end::Mobile Pricing Table-->
                                </div>

                                <!--end::Pricing Items-->

                                <!--end::Pricing Items-->
                            </div>

                            <!--end::Pricing Items-->
                        </div>
                    </div>
                </div>
                <div class="kt-pricing-4__bottom">
                    <div class="kt-pricing-4__bottok-container kt-pricing-4__bottok-container--fixed">
                        <div class="kt-pricing-4__bottom-items">
                            <div class="kt-pricing-4__bottom-item">
                                Vidéo des tutoriels
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                        </div>
                        <div class="kt-pricing-4__bottom-items">
                            <div class="kt-pricing-4__bottom-item">
                                Sources des tutoriels
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                        </div>
                        <div class="kt-pricing-4__bottom-items">
                            <div class="kt-pricing-4__bottom-item">
                                Tutoriels en avant première (j-3)
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                <i class="fa fa-check kt-font-success"></i>
                            </div>
                        </div>
                        <div class="kt-pricing-4__bottom-items">
                            <div class="kt-pricing-4__bottom-item">
                                Accès au contenue Payant
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                3 Objets
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                20 Objets
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                50 Objets
                            </div>
                            <div class="kt-pricing-4__bottom-item">
                                100 Objets
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Basic Pricing 4-->
        </div>
    </div>
    <div class="modal fade" id="addPaymentCarte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout d'un mode de paiement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form class="kt-form" action="{{ route('Account.addMethodPayment') }}" id="formAddPayment">
                    @csrf
                    @include("layout.includes.alert")
                    <input type="hidden" id="plan" name="plan">
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
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/account/premium.js') }}"></script>
@endsection
