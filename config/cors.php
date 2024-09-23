<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    // Specifies the routes that CORS should be applied to.
    // 'api/*' ensures that all your API routes are covered.
    // 'sanctum/csrf-cookie' is included for Laravel Sanctum CSRF protection.

    'allowed_methods' => ['*'],
    // Allows all HTTP methods (GET, POST, PUT, DELETE, etc.).

    'allowed_origins' => ['http://localhost:3000'],
    // This defines the allowed origins for your CORS policy.
    // You have `http://localhost:3000` specified, which is commonly used for development with React or other frontend frameworks running on port 3000.

    'allowed_origins_patterns' => [],
    // An empty array here means you are not using patterns to match the origins.

    'allowed_headers' => ['*'],
    // Allows all headers to be passed in the request. If you want more control, you can specify specific headers.

    'exposed_headers' => [],
    // This specifies headers that should be exposed to the browser. Typically left empty unless you need to expose specific headers.

    'max_age' => 0,
    // Specifies how long the results of a preflight request can be cached. A value of `0` means no caching.

    'supports_credentials' => true,
    // This allows cookies to be sent with cross-origin requests, which is important if you're using Laravel Sanctum for authentication.
];

