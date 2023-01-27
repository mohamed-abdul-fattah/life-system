<?php

/**
 * System Configuration Variables.
 */
return [
    'DB_HOST'  => env('DB_HOST'),
    'DB_NAME'  => env('DB_NAME'),
    'DB_USER'  => env('DB_USER'),
    'DB_PASS'  => env('DB_PASSWORD'),
    'ADMIN'    => env('ADMIN_USERNAME'),
    'PASSWORD' => env('ADMIN_PASSWORD'),
    'APP_NAME' => 'MyMonitor',
    'APP_URL'  => env('APP_URL', 'http://localhost:3000/'),
];
