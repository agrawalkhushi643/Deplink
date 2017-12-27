<?php

/** @var \Phalcon\Mvc\Router $router */
$router->addGet('/', 'Index::index')->setName('homepage');
$router->addGet('/join', 'Auth::join')->setName('join');
$router->addGet('/join/{provider}', 'Auth::socialJoin')->setName('social-join');
$router->addGet('/login', 'Auth::login')->setName('login');
$router->addGet('/logout', 'Auth::logout')->setName('logout');
