<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'twitter' => [
        'client_id' => "CW3IB5TFJQfoJ3WwYrKiQp31h",
        'client_secret' => "oovTnCZ6b5Ib4eGjZW59UkHR2B1wwGzzwNIBKQWqcrL5y1t0Vk",
        'redirect' => env("APP_URL").'/provider/callback/twitter'
    ],

    'facebook' => [
        'client_id' => "348094415702383",
        'client_secret' => "d3bd79de359f99258c2f6528e6e38bdb",
        'access_token' => "EAAE8lwvZCCW8BAKK5YV1ZCoPdHyJP36CWLpdP0eaBPg8qSRgZB5jm2qrHOuqo2mtw83VRkgAeLwJaZCGjSc3Lh02AoSqfVwEObRKPTlswP4qiJtRkkUPiONoNsNi9mPUJHtk2nDCgWD8NLCG4YFIMeXWqiABhYZCWRokyLDxPWasBwhHqZBoTTOPOs9x6vZCZBovVV9FlpRL7amzIZCEz1U1hocZC3rNywZComlBZAUsTF9NjgZDZD",
        'redirect' => env('APP_URL').'/provider/callback/facebook'
    ],

    'discord' => [
        'client_id' => "429292874883006465",
        'client_secret' => "40eXsxKJG0K0aw4gcy0Fn8-tjE2sYWyZ",
        'redirect' => env('APP_URL').'/provider/callback/discord'
    ],

    'stripe' => [
        'secret' => env("STRIPE_SECRET"),
    ],

];
