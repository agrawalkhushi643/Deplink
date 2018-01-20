<?php

use Phalcon\Mvc\View;

/** @var Phalcon\Di $di */
$di->setShared('view', function () use($di) {
    $view = new View();
    $dir = $di->get('config')->path('view.dir');

    // Config directory structure
    $view->setViewsDir(ROOT_DIR ."/$dir/");
    //$view->setLayoutsDir(...);
    //$view->setPartialsDir(...);

    // Bind supported engines
    $view->registerEngines(['.volt' => 'volt']);

    // Make config visible globally
    $view->setVar('config', $di->get('config'));

    return $view;
});
