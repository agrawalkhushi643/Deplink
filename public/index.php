<?php

use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;

$di = new FactoryDefault();
require '../vendor/autoload.php';

// Register autoloader
require '../bootstrap/config.php';
require '../bootstrap/logger.php';
require '../bootstrap/router.php';
require '../bootstrap/session.php';
require '../bootstrap/view.php';
require '../bootstrap/volt.php';

// Handle the request
try {
    $application = new Application($di);
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo $e->getMessage();
}
