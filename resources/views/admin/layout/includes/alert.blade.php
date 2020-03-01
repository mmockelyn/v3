@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <div class="alert-text">
            <h4 class="alert-heading">Erreur !</h4>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(session('type') == 'success')
    <div id="showAlerting" class="alert alert-success fade show" role="alert">
        <div class="alert-icon"><i class="flaticon2-check-mark"></i></div>
        <div class="alert-text">{{ session('message') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if(session('type') == 'warning')
    <div id="showAlerting" class="alert alert-warning fade show" role="alert">
        <div class="alert-icon"><i class="flaticon2-warning"></i></div>
        <div class="alert-text">{{ session('message') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif

@if(session('type') == 'error')
    <div id="showAlerting" class="alert alert-error fade show" role="alert">
        <div class="alert-icon"><i class="flaticon2-time"></i></div>
        <div class="alert-text">{{ session('message') }}</div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif
