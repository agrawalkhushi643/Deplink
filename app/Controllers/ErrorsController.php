<?php

namespace Deplink\Repository\App\Controllers;

class ErrorsController extends BaseController
{
    public function code404Action()
    {
        $this->response->setStatusCode(404);
        $this->view->setMainView('_errors/404');
    }
}
