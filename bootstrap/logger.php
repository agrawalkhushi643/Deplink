<?php

use Phalcon\Logger\Adapter\File;

/** @var Phalcon\Di $di */
$di->setShared('logger', function () use($di) {
    $file = $di->get('config')->path('logger.file');
    $logger = new File(ROOT_DIR ."/$file");

    $logLevels = [
        'debug' => 7,
        'info' => 6,
        'notice' => 5,
        'warning' => 4,
        'error' => 3,
        'alert' => 2,
        'critical' => 1,
        'emergency' => 0,
    ];

    $level = $di->get('config')->path('logger.level');
    $logger->setLogLevel($logLevels[$level]);

    return $logger;
});
