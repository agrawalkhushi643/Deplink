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

// Load services from the bootstrap directory.
$files = scandir(ROOT_DIR . '/bootstrap');
$services = array_diff($files, ['..', '.']);
foreach($services as $service) {
    require ROOT_DIR .'/bootstrap/'. $service;
}
