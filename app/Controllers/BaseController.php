<?php

namespace Deplink\Repository\App\Controllers;

use Phalcon\Config as Config;
use Phalcon\Logger\AdapterInterface as Logger;
use Phalcon\Mvc\Controller;

/**
 * @property Config $config
 * @property Logger $logger
 */
class BaseController extends Controller
{
    /**
     * Show "404 Not found" error page.
     */
    protected function notFound()
    {
        return $this->dispatcher->forward([
            'controller' => 'Errors',
            'action' => 'code404',
        ]);
    }
}
