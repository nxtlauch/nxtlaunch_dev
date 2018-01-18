<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '183099538951717',
        'client_secret' => 'ef4cc3e8d09dcb5378bd0669f1fd18d6',
        'redirect' => 'http://dnmsecurexxxcvt140093.com/nxtlaunch_dev/login/facebook/callback',
    ],
    /*'facebook' => [
        'client_id' => '1076603105775368',
        'client_secret' => '1fae003191020ee5126cf8ab6700d836',
        'redirect' => 'http://plx4.website/nxtlaunch_dev/login/facebook/callback',
    ],*/

];
