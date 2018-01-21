<?php

use Phalcon\Mvc\Url;

$di->setShared('url', function () {
    $url = new Url();
    $url->setBaseUri('/');

    return $url;
});
