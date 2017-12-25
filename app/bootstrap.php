<?php

use Phalcon\Di\FactoryDefault;

$di = new FactoryDefault();
require __DIR__ .'/../vendor/autoload.php';

// Register autoloader
require __DIR__ .'/../bootstrap/config.php';
require __DIR__ .'/../bootstrap/logger.php';
require __DIR__ .'/../bootstrap/router.php';
require __DIR__ .'/../bootstrap/session.php';
require __DIR__ .'/../bootstrap/view.php';
require __DIR__ .'/../bootstrap/volt.php';
