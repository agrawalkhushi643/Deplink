<?php

use Phalcon\Di\FactoryDefault;

define('APP_DIR', realpath(__DIR__ .'/../app/'));
define('ROOT_DIR', realpath(__DIR__ .'/../'));

require ROOT_DIR .'/vendor/autoload.php';

try {
    // Load .env configuration.
    $dotenv = new Dotenv\Dotenv(ROOT_DIR);
    $dotenv->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    // Skip loading if .env file is not set
    // (this catch block should be empty).
}

// Initialize DI container.
$di = new FactoryDefault();

// Autoload helpers and DI services.
require ROOT_DIR .'/helpers/autoload.php';
autoload($di, ['helpers', 'bootstrap']);

// Start pretty error page handler
// (https://github.com/filp/whoops).
$di->get('whoops')->register();
