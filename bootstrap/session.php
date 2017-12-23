<?php

use Phalcon\Session\Adapter\Files;

/** @var Phalcon\Di $di */
$di->setShared('session', function () use ($di) {
    $session = new Files();
    $session->start();

    return $session;
});
