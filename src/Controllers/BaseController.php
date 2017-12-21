<?php

namespace Deplink\Repository\Controllers;

use Phalcon\Config\Adapter\Ini;
use Phalcon\Logger\Adapter\File;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\View;

/**
 * @property Ini $config
 * @property File $logger
 * @property Router $router
 * @property View $view
 */
class BaseController extends Controller
{
}
