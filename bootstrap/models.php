<?php

use Phalcon\Mvc\Model\Manager;

$di->set('models', function () {
    return new Manager();
});
