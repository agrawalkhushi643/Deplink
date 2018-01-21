<?php

use Whoops\Handler\Handler;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$di->setShared('whoops', function () use($di) {
    $whoops = new Run();
    $whoops->pushHandler(new PrettyPageHandler());

    // Send JSON for Ajax request.
    if (\Whoops\Util\Misc::isAjaxRequest()){
        $whoops->pushHandler(new JsonResponseHandler());
    }

    // Send "500 Internal Error" in production environment.
    if($di->get('config')->path('app.debug') !== true) {
        $whoops->pushHandler(function(\Throwable $exception) use ($di) {
            $di->get('logger')->error("{message} in {file}:{line}:\r\n{stackTrace}", [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'stackTrace' => $exception->getTraceAsString(),
            ]);

            echo $di->get('view')->getRender('_errors', '500', [
                'exception' => $exception
            ]);

            return Handler::QUIT;
        });
    }

    return $whoops;
});

