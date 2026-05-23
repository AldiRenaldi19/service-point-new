<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 1. AUTHENTICATION DEFAULTS
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | 2. AUTHENTICATION GUARDS
    |--------------------------------------------------------------------------
    | Menggunakan sistem guard tunggal 'web' berbasis session terenkripsi.
    | Otorisasi hak akses Admin/Staff dikendalikan penuh oleh model User.
    |
    */
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 3. USER PROVIDERS
    |--------------------------------------------------------------------------
    */
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 4. PASSWORD RESET SECURITY HARDENING
    |--------------------------------------------------------------------------
    | Pengamanan ketat fitur lupa kata sandi guna meminimalisir celah
    | Brute Force, Token Hijacking, dan Spamming Server SMTP Email.
    |
    */
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => env('AUTH_PASSWORD_RESET_EXPIRE', 15),     // Diperketat dari 60 menit menjadi 15 menit saja
            'throttle' => env('AUTH_PASSWORD_RESET_THROTTLE', 300), // Diturunkan lajunya (1 request per 5 menit / 300 detik)
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | 5. PASSWORD CONFIRMATION TIMEOUT
    |--------------------------------------------------------------------------
    | Durasi (detik) sebelum jendela konfirmasi password berisiko tinggi kedaluwarsa.
    | Default: 10800 detik (3 jam).
    |
    */
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
