<?php

namespace Deplink\Repository\App\Services\OAuth2;

use Deplink\Repository\App\Services\Injectable;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Session\Adapter;

class Client implements InjectionAwareInterface
{
    use Injectable;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var AbstractProvider
     */
    protected $provider;

    /**
     * @var AccessToken
     */
    protected $accessToken;

    /**
     * @var ResourceOwnerInterface
     */
    protected $resourceOwner;

    /**
     * @param string $name
     * @param AbstractProvider $provider
     */
    public function __construct($name, AbstractProvider $provider)
    {
        $this->name = $name;
        $this->provider = $provider;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return AbstractProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @return Adapter
     */
    private function getSession()
    {
        return $this->getDI()->get('session');
    }

    /**
     * @return Response|ResourceOwnerInterface
     */
    public function login()
    {
        if (!$this->isLoginInitialized()) {
            return $this->redirectToProviderLoginPage();
        }

        if (!$this->isStateValid()) {
            // TODO: Show error (invalid state, csrf attack)...
        }

        if (!$this->authenticate()) {
            // TODO: Redirect back and show that authentication failed (or user denied access)...
        }

        return $this->getUserData();
    }

    /**
     * @return Response
     */
    private function redirectToProviderLoginPage()
    {
        // Fetch the authorization URL from the provider; this returns the urlAuthorize
        // option and generates and applies any necessary parameters (e.g. state).
        $authorizationUrl = $this->getProvider()->getAuthorizationUrl();

        // Get the state generated for you and store it to the session.
        $this->getSession()->set('oauth2_request_state', $this->provider->getState());

        // Store the page url used later to back after valid authentication,
        // it's required because OAuth2 has one central point which handles
        // user authentication which can be triggered from many pages.
        /** @var Request $request */
        $request = $this->getDI()->get('request');
        $this->getSession()->set('oauth2_page_url', $request->getURI());

        /** @var Response $response */
        $response = $this->getDI()->get('response');
        $response->redirect($authorizationUrl);
        $response->send();

        return $response;
    }

    /**
     * Check whether user clicked login button
     * and login via provider login form.
     *
     * @return bool
     */
    private function isLoginInitialized()
    {
        return $this->getSession()->has('oauth2_code');
    }

    /**
     * Check whether the state sent to provider
     * is the same state which provider sent back.
     *
     * Used to mitigate CSRF attacks.
     *
     * @return bool
     */
    private function isStateValid()
    {
        if (!$this->getSession()->has('oauth2_request_state')
            || !$this->getSession()->has('oauth2_response_state')) {
            return false;
        }

        $requestState = $this->getSession()->get('oauth2_request_state');
        $responseState = $this->getSession()->get('oauth2_response_state');

        return $requestState === $responseState;
    }

    /**
     * @return ResourceOwnerInterface
     */
    private function getUserData()
    {
        return $this->resourceOwner;
    }

    /**
     * @param string $state
     * @param string $code
     * @return string Page url before OAuth2 authentication.
     */
    public function storeCode($state, $code)
    {
        $this->getSession()->set('oauth2_response_state', $state);
        $this->getSession()->set('oauth2_code', $code);

        return $this->getSession()->get('oauth2_page_url');
    }

    private function authenticate()
    {
        // Get and remove code (one use only).
        $code = $this->getSession()->get('oauth2_code');
        $this->getSession()->remove('oauth2_code');

        try {
            $accessToken = $this->provider->getAccessToken('authorization_code', [
                'code' => $code,
            ]);

            $this->accessToken = $accessToken;
            $this->resourceOwner = $this->provider->getResourceOwner($accessToken);

            return true;
        } catch (\Exception $e) {
            $this->getDI()->get('logger')->debug("{message} in {file}:{line}\r\n{trace}", [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return false;
        }
    }
}
