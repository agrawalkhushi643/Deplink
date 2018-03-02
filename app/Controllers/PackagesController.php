<?php

namespace Deplink\Repository\App\Controllers;

use Phalcon\Mvc\Model\ResultsetInterface;

class PackagesController extends BaseController
{
    public function indexAction()
    {
        $query = $this->models->createQuery('SELECT * FROM Users');
        /** @var ResultsetInterface $users */
        $users = $query->execute();

        var_dump($users->toArray());

        // TODO: ...
    }
}
