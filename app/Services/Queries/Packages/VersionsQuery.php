<?php

namespace App\Services\Queries\Packages;

use App\Models\Package;
use App\Services\Queries\Query;
use Illuminate\Support\Facades\Storage;

class VersionsQuery extends Query
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
     * @return VersionsQuery
     */
    public function setPackage(Package $package): VersionsQuery
    {
        $this->package = $package;
        return $this;
    }

    protected function get()
    {
        // Full path to the version archives
        // (e.g. packages/deplink/sample/1.0.0).
        $archives = Storage::files(
            $this->getPackage()->getDistDir()
        );

        // For an each item in the array of paths
        // return the last part of the path (version)
        // without .zip extensions.
        return collect($archives)->map(function($item) {
            return substr(basename($item), 0, -4);
        });
    }
}
