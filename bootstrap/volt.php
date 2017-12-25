<?php

use Phalcon\Mvc\View;

/** @var Phalcon\Di $di */
$di->set('volt', function (View $view, \Phalcon\Di $di) {
    $volt = new View\Engine\Volt($view, $di);
    $cacheDir = $di->get('config')->view->cacheDir;
    $volt->setOptions([
        'compiledPath' => __DIR__ ."/../$cacheDir/",
        'compiledSeparator' => '~',
    ]);

    return $volt;
});
