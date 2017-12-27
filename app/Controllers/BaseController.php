<?php

namespace Deplink\Repository\App\Controllers;

use Phalcon\Config as Config;
use Phalcon\Logger\AdapterInterface as Logger;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Router;
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
 */
class BaseController extends Controller
{
}
