<?php

namespace Deplink\Repository\App\Controllers;

use Phalcon\Config;

class AuthController extends BaseController
{
    public function joinAction()
    {
        // ...
    }

    /**
     * @param string $provider
     */
    public function socialJoinAction($provider)
    {
        $this->validateProvider($provider);

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
        if(!$this->config->oauth2->get($provider)) {
            $this->flashSession->error('Invalid provider');

            $this->response->redirect($this->url->get(['for' => 'join']));
            $this->response->send();
        }
    }
}
