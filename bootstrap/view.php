<?php

use Phalcon\Mvc\View;

/** @var Phalcon\Di\FactoryDefault $di */
$di->setShared('view', function () use($di) {
    $view = new View();
    $dir = $di->get('config')->view->dir;
    $view->setViewsDir("../$dir/");

    $volt = new View\Engine\Volt($view);
    $cacheDir = $di->get('config')->view->cacheDir;
    $volt->setOptions([
        'compiledPath' => "../$cacheDir/",
        'compiledSeparator' => '~',
    ]);

    $view->registerEngines(['.volt' => $volt]);

    return $view;
});
