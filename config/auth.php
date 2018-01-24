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
         * \League\OAuth2\Client\Provider\AbstractProvider
         *
         * @link http://oauth2-client.thephpleague.com
         */
        'providers' => [
            //'github' => \League\OAuth2\Client\Provider\Github::class,
        ],

        /**
         * This path contains provider-specific configuration,
         * in most cases the client id, client secret.
         *
         * Redirect uri for each provider must point to the:
         * "https://<your-domain>/oauth2/<provider-name>".
         */
        'config' => [
            'github' => [
                'clientId' => env('GITHUB_CLIENT_ID'),
                'clientSecret' => env('GITHUB_CLIENT_SECRET'),
            ],
        ],
    ],

];
