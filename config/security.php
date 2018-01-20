<?php

return [

    'join' => [
        'enabled' => getenv('JOIN_ENABLED', true),
    ],

    'oauth2' => [
        'providers' => [
            //'github' => \Deplink\Repository\App\Services\OAuth2\Providers\GitHub::class,
        ],

        'config' => [
            'github' => [
                'clientId' => 'github-client-id',
                'clientSecret' => 'github-client-secret',
                'redirectUri' => 'https://example.com/join/github',
            ],
        ],
    ],

];
