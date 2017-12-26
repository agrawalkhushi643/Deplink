<?php

use Phalcon\Config\Adapter\Ini;
use Phalcon\Mvc\Application;

require __DIR__ .'/../app/bootstrap.php';

// Overwrite default services
/** @var Ini $default */
$default = $di->get('config');
$config = $di->setShared('config', function () use($default) {
    // Overwrite using test configuration.
    if(file_exists(ROOT_DIR .'/.config.tests')) {
        $tests = new Ini(ROOT_DIR .'/.config.tests');
        $default = $default->merge($tests);
    }

    return $default;
});

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
