<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the configuration settings for Midtrans payment
    | gateway integration in your application. You can set your server key,
    | client key, environment mode, and other related settings here.
    |
    */
    'server_key' => env('MIDTRANS_SERVER_KEY', ''),
    'client_key' => env('MIDTRANS_CLIENT_KEY', ''),
    
    // ✅ PERBAIKAN: Gunakan filter_var untuk casting ke boolean
    'is_production' => filter_var(env('MIDTRANS_IS_PRODUCTION'), FILTER_VALIDATE_BOOLEAN), 
    'is_sanitized' => filter_var(env('MIDTRANS_IS_SANITIZED'), FILTER_VALIDATE_BOOLEAN),
    'is_3ds' => filter_var(env('MIDTRANS_IS_3DS'), FILTER_VALIDATE_BOOLEAN),
];