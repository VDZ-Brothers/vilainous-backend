<?php
return [
    'paths' => ['*'], // Applique CORS à toutes les routes
    'allowed_methods' => ['*'],  // Autorise toutes les méthodes HTTP
    'allowed_origins' => ['*'],  // Autorise toutes les origines
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],  // Autorise tous les headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
