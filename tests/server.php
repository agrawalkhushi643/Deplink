<?php

use Phalcon\Config\Adapter\Ini;
use Phalcon\Mvc\Application;

require __DIR__ .'/../app/bootstrap.php';

// Overwrite environment variables
try {
    // Load .env configuration.
    $dotenv = new Dotenv\Dotenv(ROOT_DIR, '.env.tests');
    $dotenv->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    // Skip loading if .env file is not set
    // (this catch block should be empty).
}

// Emulate .htaccess
$file = ROOT_DIR .'/public/'. $_SERVER['REQUEST_URI'];
if(is_file($file)) {
    // Server static files
    include $file;
    return;
}

$_GET['_url'] = $_SERVER['REQUEST_URI'];

// Handle the request
$application = new Application($di);
$response = $application->handle();
$response->send();
