<?php

namespace App\Services\Commands\Packages;

use App\Models\Package;
use App\Services\Commands\Command;

class DeleteCommand extends Command
{
    /**
     * @var Package
     */
    private $package;

    /**
     * @return Package
     */
    public function getPackage(): Package
    {
        return $this->package;
    }

    /**
     * @param Package $package
     * @return DeleteCommand
     */
    public function setPackage(Package $package): DeleteCommand
    {
        $this->package = $package;
        return $this;
    }

    /**
     * @throws \Exception
     */
    function command()
    {
        $this->getPackage()->delete();
    }
}
