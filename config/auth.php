<?php

return [

    'signup' => [
        /**
         * Setting this option to false disable sign up form
         * and all users must be added by the administrator.
         */
        'enabled' => env('SIGNUP_ENABLED', false),
    ],

    'oauth2' => [
        /**
         * List of OAuth2 providers in sign up and login form.
         *
         * Provider class must implements an interface:
         * \Deplink\Repository\App\Services\OAuth2
         */
        'providers' => [
            //'github' => \Deplink\Repository\App\Services\OAuth2\Providers\GitHub::class,
        ],

        /**
         * This path contains provider-specific configuration,
         * in most cases the client id, client secret and redirect uri.
         */
        'config' => [
            'github' => [
                'clientId' => 'github-client-id',
                'clientSecret' => 'github-client-secret',
                'redirectUri' => 'https://example.com/join/github',
            ],
        ],
    ],

];
