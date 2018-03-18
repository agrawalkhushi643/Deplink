<?php

namespace App\Services\Queries;

abstract class Query
{
    protected abstract function get();

    public function run()
    {
        return $this->get();
    }
}
