<?php

namespace Deplink\Repository\App\Services\OAuth2;

use Deplink\Repository\App\Services\DefaultInjection;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Http\Response;

class Client implements InjectionAwareInterface
{
    use DefaultInjection;

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
        $this->session->set('oauth2_request_state', $this->provider->getState());

        // Store the page url used later to back after valid authentication,
        // it's required because OAuth2 has one central point which handles
        // user authentication which can be triggered from many pages.
        $this->session->set('oauth2_page_url', $this->request->getURI());

        $this->response->redirect($authorizationUrl);
        $this->response->send();

        return $this->response;
    }

    /**
     * Check whether user clicked login button
     * and login via provider login form.
     *
     * @return bool
     */
    private function isLoginInitialized()
    {
        return $this->session->has('oauth2_code');
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
        if (!$this->session->has('oauth2_request_state')
            || !$this->session->has('oauth2_response_state')) {
            return false;
        }

        $requestState = $this->session->get('oauth2_request_state');
        $responseState = $this->session->get('oauth2_response_state');

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
        $this->session->set('oauth2_response_state', $state);
        $this->session->set('oauth2_code', $code);

        return $this->session->get('oauth2_page_url');
    }

    private function authenticate()
    {
        // Get and remove code (one use only).
        $code = $this->session->get('oauth2_code');
        $this->session->remove('oauth2_code');

        try {
            $accessToken = $this->provider->getAccessToken('authorization_code', [
                'code' => $code,
            ]);

            $this->accessToken = $accessToken;
            $this->resourceOwner = $this->provider->getResourceOwner($accessToken);

            return true;
        } catch (\Exception $e) {
            $this->logger->debug("{message} in {file}:{line}\r\n{trace}", [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return false;
        }
    }
}
