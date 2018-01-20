<?php

use Phalcon\Mvc\Url;

$di->set('url', function () {
    $url = new Url();
    $url->setBaseUri('/');

    return $url;
});
