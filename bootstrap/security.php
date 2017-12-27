<?php

use Phalcon\Security;

$di->setShared('security', function () {
    $security = new Security();

    return $security;
});
