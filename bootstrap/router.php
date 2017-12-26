<?php

use Phalcon\Mvc\Router;

/** @var Phalcon\Di $di */
$di->setShared('router', function () use($di) {
    $router = new Router();

    $namespace = $di->get('config')->router->namespace;
    $router->setDefaultNamespace($namespace);

    require APP_DIR .'/routes.php';

    return $router;
});
