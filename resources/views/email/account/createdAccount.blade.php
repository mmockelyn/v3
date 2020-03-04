@extends('beautymail::templates.widgets')
    @section('content')
        @include('beautymail::templates.widgets.articleStart')
        <img
        <h4 class="secondary"><strong>Bonjour {{ $user->name }}</strong></h4>
        <p>Toutes l'équipe de Trainznation vous souhaite la bienvenue sur le site de Trainznation.</p>

        @include('beautymail::templates.widgets.articleEnd')


    @endsection
@stop
