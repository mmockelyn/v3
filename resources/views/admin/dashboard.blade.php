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
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Secteur</th>
                        <th>Titre</th>
                        <th>Message</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody id="signalement">

                </tbody>
            </table>
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
