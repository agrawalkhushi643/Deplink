<?php

namespace App\Services\Commands\Packages;

use App\Models\Package;
use App\Services\Commands\Command;
use Illuminate\Validation\Rule;

class RenameCommand extends Command
{
    /**
     * @var Package
     */
    private $package;

    /**
     * @var string
     */
    private $newName;

    /**
     * @return Package
     */
    public function getPackage(): Package
    {
        return $this->package;
    }

    /**
     * @param Package $package
     * @return RenameCommand
     */
    public function setPackage(Package $package): RenameCommand
    {
        $this->package = $package;
        return $this;
    }

    /**
     * @return string
     */
    public function getNewName(): string
    {
        return $this->newName;
    }

    /**
     * @param string $name
     * @return RenameCommand
     */
    public function setNewName(string $name): RenameCommand
    {
        $this->newName = $name;
        return $this;
    }

    function getRules(): array
    {
        return [
            'name' => [
                'required', 'string', 'min:1', 'max:255', 'alphanum',
                Rule::unique('packages', 'name')->where('org', $this->getPackage()->org),
            ],
        ];
    }

    function getData(): array
    {
        return [
            'name' => $this->getNewName(),
        ];
    }

    /**
     * @throws \Throwable
     */
    function command()
    {
        $package = $this->getPackage();
        $package->name = $this->getNewName();
        $package->saveOrFail();
    }
}
