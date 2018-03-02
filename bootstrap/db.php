<?php

use Phalcon\Db\Adapter\Pdo\Factory;

/** @var Phalcon\Di $di */
$di->set('db', function () use ($di) {
    $config = $di->get('config')->path('database.default');
    return Factory::load($config);
});
