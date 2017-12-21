<?php

use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;

$di = new FactoryDefault();
require '../vendor/autoload.php';

// Register autoloader
$loader = new Loader();
require '../bootstrap/config.php';
require '../bootstrap/logger.php';
require '../bootstrap/router.php';
require '../bootstrap/view.php';

// Handle the request
$loader->register();
$application = new Application($di);

try {
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo $e->getMessage();
}
