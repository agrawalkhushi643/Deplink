<?php

namespace App\Services\Queries\Packages;

use App\Models\Package;
use App\Services\Queries\Query;

class ExistsQuery extends Query
{
    /**
     * @var string
     */
    private $org;

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getOrg(): string
    {
        return $this->org;
    }

    /**
     * @param string $org
     * @return ExistsQuery
     */
    public function setOrg(string $org): ExistsQuery
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
     * @return ExistsQuery
     */
    public function setName(string $name): ExistsQuery
    {
        $this->name = $name;
        return $this;
    }

    protected function get()
    {
        return Package::where('org', $this->getOrg())
            ->where('name', $this->getName())
            ->exists();
    }
}
