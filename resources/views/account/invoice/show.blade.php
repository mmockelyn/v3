@extends("layout.front")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title"></h3>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="{{ route('Account.index') }}" class="btn btn-default"><i class="fa fa-arrow-alt-circle-left"></i> Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("content")
    <div class="kt-portlet" id="invoice" data-id="{{ $invoice_id }}">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-invoice-1">
                <div class="kt-invoice__head" style="background-image: url(/assets/media/bg/bg-6.jpg);">
                    <div class="kt-invoice__container">
                        <div class="kt-invoice__brand">
                            <h1 class="kt-invoice__title">FACTURE</h1>
                            <div href="#" class="kt-invoice__logo">
                                <a href="#"><img src="/storage/logos/logo-long.png"></a>
                                <span class="kt-invoice__desc">
                                    <span>TrainzNation</span>
                                    <span>22 Rue Maryse Bastié</span>
                                    <span>85100 Les Sables d'Olonne, FR</span>
                                </span>
                            </div>
                        </div>
                        <div class="kt-invoice__items">
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__subtitle">DATE</span>
                                <span class="kt-invoice__text" id="fieldDate"></span>
                            </div>
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__subtitle">INVOICE NO.</span>
                                <span class="kt-invoice__text" id="fieldNumberInvoice"></span>
                            </div>
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__subtitle">INVOICE TO.</span>
                                <span class="kt-invoice__text" id="fieldInvoiceTo"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-invoice__body">
                    <div class="kt-invoice__container">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>DESCRIPTION</th>
                                    <th>PRIX UNITAIRE</th>
                                    <th>QTE</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody id="contentItems">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="kt-invoice__footer">
                    <div class="kt-invoice__container">
                        <div class="kt-invoice__bank">
                            <div class="kt-invoice__title">Information de paiement</div>
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__label">Payer par:</span>
                                <span class="kt-invoice__value">Carte Bancaire</span></span>
                            </div>
                        </div>
                        <div class="kt-invoice__total">
                            <span class="kt-invoice__title">Montant Total</span>
                            <span class="kt-invoice__price" id="totalInvoice"></span>
                        </div>
                    </div>
                </div>
                <div class="kt-invoice__actions">
                    <div class="kt-invoice__container">
                        <button type="button" class="btn btn-label-brand btn-bold" onclick="window.print();">Télécharger la facture</button>
                        <button type="button" class="btn btn-brand btn-bold" onclick="window.print();">Imprimer la facture</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/account/invoice.js') }}"></script>
@endsection
