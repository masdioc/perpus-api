<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'docs/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'], // Atau batasi ke ['http://localhost:8000']

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,
];
