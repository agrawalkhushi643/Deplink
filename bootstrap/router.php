<?php

use Phalcon\Mvc\Router;

/** @var Phalcon\Di\FactoryDefault $di */
$di->setShared('router', function () use($di) {
    $router = new Router();

    $namespace = $di->get('config')->router->namespace;
    $router->setDefaultNamespace($namespace);

    require '../src/routes.php';

    return $router;
});
