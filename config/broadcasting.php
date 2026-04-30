<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | Aquí defines el driver de broadcasting que Laravel usará por defecto.
    | Lo mejor es tomar el valor de la variable de entorno BROADCAST_DRIVER.
    |
    */

    'default' => env('BROADCAST_DRIVER', 'pusher'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Aquí defines las conexiones para cada driver disponible para broadcasting.
    | Cada conexión debe tener su propia configuración.
    |
    */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => false,
                'host' => env('PUSHER_HOST', 'localhost'),
                'port' => env('PUSHER_PORT', 6001),
                'scheme' => env('PUSHER_SCHEME', 'http'),
                'encrypted' => false,
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',           // Se refiere a la conexión Redis que configures en config/database.php
        ],

        'log' => [
            'driver' => 'log',                   // Para debugging, escribe eventos en el log
        ],

        'null' => [
            'driver' => 'null',                  // Para deshabilitar broadcasting
        ],

    ],

];
