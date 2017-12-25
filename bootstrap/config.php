<?php

use Phalcon\Config\Adapter\Ini;

/** @var Phalcon\Di $di */
$di->setShared('config', function () {
    $default = new Ini(__DIR__ .'/../.config.default');

    // Overwrite using environment-specific configuration.
    if(file_exists(__DIR__ .'/../.config')) {
        $custom = new Ini(__DIR__ .'/../.config');
        $default = $default->merge($custom);
    }

    return $default;
});
