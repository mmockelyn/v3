@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <!--<div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container ">
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <button class="btn btn-primary"><i class="la la-plus"></i> </button>
                </div>
            </div>
        </div>
    </div>-->
@endsection

@section("content")
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-euro"></i>
					</span>
                <h3 class="kt-portlet__head-title">
                    Revenues
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <div class="kt-widget25">
                <span class="kt-widget25__stats m-font-brand">{{ \App\HelpersClass\Invoice\InvoiceHelper::loadRevenueIcomes() }}</span>
                <span class="kt-widget25__subtitle">Total des revenues cette année</span>
            </div>
            <div id="kt_morris_1">
                {!! $chart->container() !!}
            </div>
        </div>
    </div>
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="flaticon2-warning"></i>
					</span>
                <h3 class="kt-portlet__head-title">
                    Signalements
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-actions">
                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md">
                        <i class="flaticon2-search-1"></i>
                    </a>
                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md">
                        <i class="flaticon2-gear"></i>
                    </a>
                    <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md">
                        <i class="flaticon-more-1"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Search Form -->
            <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
                <div class="row align-items-center">
                    <div class="col-xl-8 order-2 order-xl-1">
                        <div class="row align-items-center">
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-input-icon kt-input-icon--left">
                                    <input type="text" class="form-control" placeholder="Search..." id="generalSearch">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--left">
																	<span><i class="la la-search"></i></span>
																</span>
                                </div>
                            </div>
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Status:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_status">
                                            <option value="">All</option>
                                            <option value="1">Pending</option>
                                            <option value="2">Delivered</option>
                                            <option value="3">Canceled</option>
                                            <option value="4">Success</option>
                                            <option value="5">Info</option>
                                            <option value="6">Danger</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                <div class="kt-form__group kt-form__group--inline">
                                    <div class="kt-form__label">
                                        <label>Type:</label>
                                    </div>
                                    <div class="kt-form__control">
                                        <select class="form-control bootstrap-select" id="kt_form_type">
                                            <option value="">All</option>
                                            <option value="1">Online</option>
                                            <option value="2">Retail</option>
                                            <option value="3">Direct</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 order-1 order-xl-2 kt-align-right">
                        <a href="#" class="btn btn-default kt-hidden">
                            <i class="la la-cart-plus"></i> New Order
                        </a>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-lg d-xl-none"></div>
                    </div>
                </div>
            </div>

            <!--end: Search Form -->
        </div>
        <div class="kt-portlet__body">
            <div id="signalement" class="kt-datatable"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-newspaper-o"></i>
					</span>
                        <h3 class="kt-portlet__head-title">
                            Derniers Articles
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">

                    </div>
                </div>
                <div class="kt-portlet__body" id="loadLatestBlog">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="la la-youtube-play"></i>
					</span>
                        <h3 class="kt-portlet__head-title">
                            Derniers tutoriels
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">

                    </div>
                </div>
                <div class="kt-portlet__body" id="loadLatestTutoriel">

                </div>
            </div>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('vendor/larapex-charts/apexcharts.js') }}"></script>
    {{ $chart->script() }}
    <script src="{{ asset('js/admin/index.js') }}"></script>
@endsection
