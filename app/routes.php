<?php

/** @var \Phalcon\Mvc\Router $router */
$router->addGet('/join', 'Auth::join')->setName('join');
$router->addGet('/join/{provider}', 'Auth::socialJoin')->setName('social-join');
$router->addGet('/login', 'Auth::login');
