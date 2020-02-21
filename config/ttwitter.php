<?php

// You can find the keys here : https://apps.twitter.com/

return [
    'debug'               => function_exists('env') ? env('APP_DEBUG', false) : false,

    'API_URL'             => 'api.twitter.com',
    'UPLOAD_URL'          => 'upload.twitter.com',
    'API_VERSION'         => '1.1',
    'AUTHENTICATE_URL'    => 'https://api.twitter.com/oauth/authenticate',
    'AUTHORIZE_URL'       => 'https://api.twitter.com/oauth/authorize',
    'ACCESS_TOKEN_URL'    => 'https://api.twitter.com/oauth/access_token',
    'REQUEST_TOKEN_URL'   => 'https://api.twitter.com/oauth/request_token',
    'USE_SSL'             => true,

    'CONSUMER_KEY'        => function_exists('env') ? env('TWITTER_CONSUMER_KEY', 'CW3IB5TFJQfoJ3WwYrKiQp31h') : '',
    'CONSUMER_SECRET'     => function_exists('env') ? env('TWITTER_CONSUMER_SECRET', 'oovTnCZ6b5Ib4eGjZW59UkHR2B1wwGzzwNIBKQWqcrL5y1t0Vk') : '',
    'ACCESS_TOKEN'        => function_exists('env') ? env('TWITTER_ACCESS_TOKEN', '1009074959304544257-fcgzX0VjSeurpFCKCMOet5b90Qet4p') : '',
    'ACCESS_TOKEN_SECRET' => function_exists('env') ? env('TWITTER_ACCESS_TOKEN_SECRET', 'AF05miTZ9D7eyX95wMIK4xbHl8Mv2Aa3mtWiYtfgfNcrK') : '',
];
