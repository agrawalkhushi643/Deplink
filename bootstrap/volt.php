<?php

use Phalcon\Mvc\View;

/** @var Phalcon\Di $di */
$di->set('volt', function (View $view, \Phalcon\Di $di) {
    $volt = new View\Engine\Volt($view, $di);
    $cacheDir = $di->get('config')->path('view.cacheDir');

    $volt->setOptions([
        'compiledPath' => ROOT_DIR ."/$cacheDir/",
        'compiledSeparator' => '~',
    ]);

    return $volt;
});
