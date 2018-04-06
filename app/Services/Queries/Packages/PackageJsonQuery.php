<?php

namespace App\Services\Queries\Packages;

use App\Models\Package;
use App\Services\Queries\Query;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PackageJsonQuery extends Query
{
    /**
     * @var Package
     */
    private $package;

    /**
     * @var string
     */
    private $version;

    /**
     * @return Package
     */
    public function getPackage(): Package
    {
        return $this->package;
    }

    /**
     * @param Package $package
     * @return PackageJsonQuery
     */
    public function setPackage(Package $package): PackageJsonQuery
    {
        $this->package = $package;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     * @return PackageJsonQuery
     */
    public function setVersion(string $version): PackageJsonQuery
    {
        // Remove prefix ("v" or "v.") from version number.
        $version = preg_replace('/^(v\.|v)/i', '', $version);

        $this->version = $version;
        return $this;
    }

    /**
     * @throws NotFoundHttpException
     * @return object Json decoded by the json_decode method.
     * @see json_decode
     */
    protected function get()
    {
        $zip = "{$this->getPackage()->getDistDir()}/{$this->getVersion()}.zip";

        if (!Storage::exists($zip)) {
            $dependency = "{$this->getPackage()->full_name}:{$this->getVersion()}";
            throw new NotFoundHttpException("Distributable archive for $dependency package not found.");
        }

        $path = storage_path("app/$zip");
        return json_decode(file_get_contents("zip://$path#deplink.json"));
    }
}
