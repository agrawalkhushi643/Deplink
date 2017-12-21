<?php

use Phalcon\Config\Adapter\Ini;

/** @var Phalcon\Di\FactoryDefault $di */
$di->setShared('config', function () {
    $default = new Ini('../.config.default');

    // Overwrite using environment-specific configuration.
    if(file_exists('../.config')) {
        $custom = new Ini('../.config');
        $default = $default->merge($custom);
    }

    return $default;
});
