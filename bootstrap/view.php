<?php

use Phalcon\Mvc\View;

/** @var Phalcon\Di $di */
$di->setShared('view', function () use($di) {
    $view = new View();
    $dir = $di->get('config')->view->dir;

    // Config directory structure
    $view->setViewsDir("../$dir/");
    //$view->setLayoutsDir(...);
    //$view->setPartialsDir(...);

    // Bind supported engines
    $view->registerEngines(['.volt' => 'volt']);

    return $view;
});
