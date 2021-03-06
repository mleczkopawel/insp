<?php
/**
 * User: mlecz
 * Date: 30.01.2017
 * Time: 15:48
 */


return [
    'fb' => [
        'clientId' => 'id',
        'clientSecret' => 'secret',
        'redirectUri' => 'https://' . $_SERVER['HTTP_HOST'] . '/auth/callback/fb',
        'graphApiVersion' => 'v2.8'
    ],
    'google' => [
        'clientId' => 'id',
        'clientSecret' => 'secret',
        'redirectUri' => 'https://' . $_SERVER['HTTP_HOST'] . '/auth/callback/google',
        'hostedDomain' => 'https://' . $_SERVER['HTTP_HOST']'
    ]
];
