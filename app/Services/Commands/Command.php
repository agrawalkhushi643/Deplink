<?php

namespace App\Services\Commands;

use Illuminate\Support\Facades\Validator;

abstract class Command
{
    protected function getData(): array
    {
        return [];
    }

    protected function getRules(): array
    {
        return [];
    }

    abstract function command();

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function run()
    {
        $validator = Validator::make(
            $this->getData(),
            $this->getRules()
        );

        $validator->validate();
        return $this->command();
    }
}
