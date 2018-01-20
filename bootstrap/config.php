<?php

use Phalcon\Config;

/** @var Phalcon\Di $di */
$di->setShared('config', function () {
    $config = [];

    // Get configuration from each file in config directory,
    // the first key is equal the file name (without .php extension).
    $files = scandir(ROOT_DIR . '/config');
    $files = array_diff($files, ['..', '.']);
    foreach ($files as $file) {
        $name = mb_substr($file, 0, -4);
        $config[$name] = require ROOT_DIR . '/config/' . $file;
    }

    return new Config($config);
});
