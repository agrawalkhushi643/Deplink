<?php

namespace Deplink\Repository\App\Controllers;

use Deplink\Repository\App\Services\OAuth2\Factory;

class AuthController extends BaseController
{
    public function joinAction()
    {
        // ...
    }

    /**
     * Handle OAuth2 workflow:
     * - redirect to the provider login page if not authenticated,
     * - or create user if provider redirected back the code.
     *
     * @param string $providerName
     */
    public function socialJoinAction($providerName)
    {
        $this->validateProvider($providerName);

        /** @var Factory $factory */
        $factory = $this->di->get(Factory::class);
        $provider = $factory->make($providerName);

        // ...
    }

    public function loginAction()
    {
        // ...
    }

    /**
     * @param string $provider
     */
    private function validateProvider($provider)
    {
        $default = (object)['enabled' => false];
        $oauth2 = $this->config->get($provider, $default);

        if (!$oauth2->enabled) {
            $this->flashSession->error('Invalid provider');

            $this->response->redirect($this->url->get(['for' => 'join']));
            $this->response->send();
        }
    }
}
