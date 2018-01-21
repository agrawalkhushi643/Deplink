<?php

use Phalcon\Mvc\Application;

require __DIR__ . '/../app/bootstrap.php';

$application = new Application($di);
$response = $application->handle();
$response->send();
