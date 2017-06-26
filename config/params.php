<?php

return [
    'adminEmail' => 'admin@example.com',
    'excludedPaths' => [
        'site/login',
        'site/error',
        'site/sign-in',
        'site/sign-up',
        'site/register'
    ],
    'api_url' => getenv('API_URL'),
    'oauth' => [
        'clientId' => getenv("CLIENT_ID"),
        'clientSecret' => getenv("CLIENT_SECRET"),
        'authUrl' => getenv("OAUTH_URL"),
        'tokenUrl' => getenv("TOKEN_URL"),
        'enabled' => getenv("OAUTH_ENABLED") !== "false"
    ],
];