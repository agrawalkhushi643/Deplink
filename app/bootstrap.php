<?php

use Phalcon\Di\FactoryDefault;

define('APP_DIR', realpath(__DIR__ .'/../app/'));
define('ROOT_DIR', realpath(__DIR__ .'/../'));

$di = new FactoryDefault();
require ROOT_DIR .'/vendor/autoload.php';

// Register autoloader
require ROOT_DIR .'/bootstrap/config.php';
require ROOT_DIR .'/bootstrap/logger.php';
require ROOT_DIR .'/bootstrap/router.php';
require ROOT_DIR .'/bootstrap/security.php';
require ROOT_DIR .'/bootstrap/session.php';
require ROOT_DIR .'/bootstrap/view.php';
require ROOT_DIR .'/bootstrap/volt.php';
