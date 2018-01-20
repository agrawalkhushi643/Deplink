<?php

namespace Deplink\Repository\App\Controllers;

use Phalcon\Config as Config;
use Phalcon\Http\Request;
use Phalcon\Logger\AdapterInterface as Logger;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Security;
use Phalcon\Session\AdapterInterface as Session;

/**
 * @property Config $config
 * @property Logger $logger
 * @property Router $router
 * @property Security $security
 * @property Session $session
 * @property View $view
 * @property Url $url
 * @property Request $request
 */
class BaseController extends Controller
{
    protected function notFound()
    {
        return $this->dispatcher->forward([
            'controller' => 'Errors',
            'action' => 'code404',
        ]);
    }
}
