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
        <div class="kt-portlet__body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h4>Erreur</h4>
                    <h1 class="kt-font-bolder kt-font-danger">{{ $json->totals->errors }}</h1>
                </div>
                <div class="col-md-4 text-center">
                    <h4>Attention</h4>
                    <h1 class="kt-font-bolder">{{ $json->totals->warnings }}</h1>
                </div>
                <div class="col-md-4 text-center">
                    <h4>Réparable</h4>
                    <h1 class="kt-font-bolder">{{ $json->totals->fixable }}</h1>
                </div>
            </div>
        </div>
    </div>
    @foreach($xml->file as $a)
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
					<span class="kt-portlet__head-icon">
						<i class="flaticon2-calendar-2"></i>
					</span>
                    <h3 class="kt-portlet__head-title">
                        {!! $a->attributes()->name !!}
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
                @if($a->attributes()->errors > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr class="kt-bg-danger">
                            <th>Erreur ({{ $a->attributes()->errors }})</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($a->error as $e)
                        <tr>
                            <td>{{ $e }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif
                    @if($a->attributes()->warning > 0)
                        <table class="table table-bordered">
                            <thead>
                            <tr class="kt-bg-warning">
                                <th>Attention ({{ $a->attributes()->warning }})</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($a->warning as $e)
                                <tr>
                                    <td>{{ $e }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
            </div>
        </div>
    @endforeach
@endsection

@section("script")
@endsection
