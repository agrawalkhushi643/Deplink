<?php

use Phalcon\Logger\Adapter\File;

/** @var Phalcon\Di $di */
$di->setShared('logger', function () use($di) {
    $file = $di->get('config')->logger->file;
    $logger = new File("../$file");

    $logLevels = [
        'DEBUG' => 7,
        'INFO' => 6,
        'NOTICE' => 5,
        'WARNING' => 4,
        'ERROR' => 3,
        'ALERT' => 2,
        'CRITICAL' => 1,
        'EMERGENCY' => 0,
    ];

    $level = $di->get('config')->logger->level;
    $logger->setLogLevel($logLevels[$level]);

    return $logger;
});
