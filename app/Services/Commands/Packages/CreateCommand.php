<?php

namespace App\Services\Commands\Packages;

use App\Models\Package;
use App\Models\User;
use App\Services\Commands\Command;
use Illuminate\Validation\Rule;

class CreateCommand extends Command
{
    protected $validatable = Package::class;

    /**
     * @var string
     */
    private $org;

    /**
     * @var string
     */
    private $name;

    /**
     * @var User
     */
    protected $owner;

    /**
     * @return string
     */
    public function getOrg(): string
    {
        return $this->org;
    }

    /**
     * @param string $org
     * @return CreateCommand
     */
    public function setOrg(string $org): CreateCommand
    {
        $this->org = $org;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CreateCommand
     */
    public function setName(string $name): CreateCommand
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     * @return CreateCommand
     */
    public function setOwner(User $owner): CreateCommand
    {
        $this->owner = $owner;
        return $this;
    }

    function getRules(): array
    {
        return [
            'org' => [
                'required', 'string', 'min:1', 'max:255', 'alphanum',
            ],
            'name' => [
                'required', 'string', 'min:1', 'max:255', 'alphanum',
                Rule::unique('packages', 'name')->where('org', $this->getOrg()),
            ],
            'owner_id' => [
                'required', 'integer',
                Rule::exists('users', 'id'),
            ],
        ];
    }

    function getData(): array
    {
        return [
            'org' => $this->getOrg(),
            'name' => $this->getName(),
            'owner_id' => $this->getOwner()->getKey(),
        ];
    }

    /**
     * @throws \Throwable
     */
    function command()
    {
        $package = new Package();
        $package->org = $this->getOrg();
        $package->name = $this->getName();
        $package->owner()->associate($this->getOwner());

        $package->saveOrFail();
    }
}
