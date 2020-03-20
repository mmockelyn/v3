@component('mail::message')
    Bonjour {{ $user->name }},

    Votre compte à été bannie.

    Celà peut être dù au non respect des conditions d'utilisations de notre site.

    Veuillez nous contacter à l'adresse <a
        href="mailto:trainznation@gmail.com">trainznation@gmail.com</a> afin de demander le déblocage de votre compte.
@endcomponent
