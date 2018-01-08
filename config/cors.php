<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders & allowedMethods
    | can be set to ['*'] to accept any value.
    |
    */

    'supportsCredentials'    => true,
    'allowedOrigins'         => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders'         => ['Content-Type', 'X-Requested-With'],
    'allowedMethods'         => ['DELETE', 'GET', 'POST', 'PUT'],
    'exposedHeaders'         => [],
    'maxAge'                 => 0,
];
