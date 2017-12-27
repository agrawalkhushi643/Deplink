<?php

namespace Deplink\Repository\App\Controllers;

use Deplink\Repository\App\Services\OAuth2\Exceptions\ProviderNotSupportedException;
use Deplink\Repository\App\Services\OAuth2\Factory;

class AuthController extends BaseController
{
    /**
     * Show signup page with social buttons.
     */
    public function joinAction()
    {
        $this->redirectIfSignupDisabled();
    }

    /**
     * Handle OAuth2 workflow:
     * - redirect to the provider login page if not authenticated,
     * - or create user if provider redirected back the code.
     *
     * @param string $providerName
     * @throws ProviderNotSupportedException
     */
    public function socialJoinAction($providerName)
    {
        $this->redirectIfSignupDisabled();
        $this->redirectIfProviderDisabled($providerName);

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
     * Logout user and redirect to homepage.
     */
    public function logoutAction()
    {
        $this->session->destroy();

        $homepageUrl = $this->url->get(['for' => 'homepage']);
        $this->response->redirect($homepageUrl);
    }

    /**
     * Check whether given provider is enabled in configuration.
     *
     * Redirect back if provider isn't supported.
     *
     * @param string $provider
     */
    private function redirectIfProviderDisabled($provider)
    {
        $default = (object)['enabled' => false];
        $oauth2 = $this->config->get($provider, $default);

        if (!$oauth2->enabled) {
            $this->flashSession->error('Invalid provider');

            $joinUrl = $this->url->get(['for' => 'join']);
            $this->response->redirect($joinUrl);
            $this->response->send();
        }
    }

    /**
     * Check whether signup is enabled in configuration.
     *
     * Redirect to login page if disabled.
     */
    private function redirectIfSignupDisabled()
    {
        if(!$this->config->auth->signup) {
            $homepageUrl = $this->url->get(['for' => 'login']);
            $this->response->redirect($homepageUrl);
            $this->response->send();
        }
    }
}
