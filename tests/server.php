<?php

use Phalcon\Mvc\Application;

require __DIR__ .'/../app/bootstrap.php';

// Emulate .htaccess file.
$file = ROOT_DIR .'/public/'. $_SERVER['REQUEST_URI'];
if(is_file($file)) {
    // Server static files
    include $file;
    return;
}

$_GET['_url'] = $_SERVER['REQUEST_URI'];

// Handle the request.
$application = new Application($di);
$response = $application->handle();
$response->send();
