@extends("admin.layout.app")

@section("style")

@endsection

@section("subheader")
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    Edition: {{ $user->name }} </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="{{ route('Back.dashboard') }}" class="kt-subheader__breadcrumbs-home"><i
                            class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{ route('Back.User.index') }}" class="kt-subheader__breadcrumbs-link">Utilisateurs </a>

                    <span
                        class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Edition: {{ $user->name }} </span>
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
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <form action="/api/admin/user/{{ $user->id }}/update" class="kt-form" id="formEditUser">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="name">Adresse Mail</label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                </div>
                <div class="kt-form__actions kt-form__actions--right">
                    <button type="submit" class="btn btn-success"><i class="la la-check"></i> Valider</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("script")
    <script src="{{ asset('js/admin/user/gestion/edit.js') }}"></script>
@endsection
