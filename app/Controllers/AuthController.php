<?php

namespace Deplink\Repository\App\Controllers;

use Deplink\Repository\App\Services\OAuth2\Exceptions\ProviderNotSupportedException;
use Deplink\Repository\App\Services\OAuth2\Factory;
use Phalcon\Http\ResponseInterface;

class AuthController extends BaseController
{
    /**
     * Show join page with social buttons.
     */
    public function joinAction()
    {
        // Show 404 page if joining is disabled.
        if(!$this->isSignupEnabled()) {
            return $this->notFound();
        }
    }

    /**
     * Handle OAuth2 workflow:
     * - redirect to the provider login page if not authenticated,
     * - or create user if provider redirected back the code.
     *
     * @param string $providerName
     * @return ResponseInterface
     * @throws ProviderNotSupportedException
     */
    public function socialJoinAction($providerName)
    {
        // Show 404 page if joining is disabled.
        if(!$this->isSignupEnabled()) {
            return $this->notFound();
        }

        // Redirect back if provider isn't supported.
        if($this->isProviderDisabled($providerName)) {
            $url = $this->url->get(['for' => 'join']);
            return $this->response->redirect($url);
        }

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
        return $this->response->redirect($homepageUrl);
    }

    /**
     * Check whether given provider is enabled in configuration.
     *
     * @param string $provider
     * @return boolean
     */
    private function isProviderDisabled($provider)
    {
        if(empty($this->config->path("auth.oauth2.providers.$provider"))) {
            $this->flashSession->error("The '$provider' provider is not supported.");
            return true;
        }

        return false;
    }

    /**
     * Check whether join page is enabled in configuration.
     *
     * @return boolean
     */
    private function isSignupEnabled()
    {
        return $this->config->path('auth.signup.enabled');
    }
}
