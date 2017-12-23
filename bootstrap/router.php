<?php

use Phalcon\Mvc\Router;

/** @var Phalcon\Di $di */
$di->setShared('router', function () use($di) {
    $router = new Router();

    $namespace = $di->get('config')->router->namespace;
    $router->setDefaultNamespace($namespace);

    require '../app/routes.php';

    return $router;
});
