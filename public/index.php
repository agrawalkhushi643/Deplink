<?php

use Phalcon\Mvc\Application;

require __DIR__ .'/../app/bootstrap.php';

// Handle the request
try {
    $application = new Application($di);
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo $e->getMessage();
}
