@component('mail::message')
    Bonjour,

    Une ou plusieurs vidéos ont été mis à jours:
    **Nombre de Vidéo mise à jour:** {{ $count }}
    @if($count != 0)
        @foreach($arr as $item)
            - {{ $item }}
        @endforeach
    @endif
@endcomponent
