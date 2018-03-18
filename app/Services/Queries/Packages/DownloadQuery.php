<?php

namespace App\Services\Queries\Packages;

use App\Models\Package;
use App\Services\Queries\Query;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DownloadQuery extends Query
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
     * @return DownloadQuery
     */
    public function setPackage(Package $package): DownloadQuery
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
     * @return DownloadQuery
     */
    public function setVersion(string $version): DownloadQuery
    {
        // Remove prefix ("v" or "v.") from version number.
        $version = preg_replace('/^(v\.|v)/i', '', $version);

        $this->version = $version;
        return $this;
    }

    /**
     * @throws NotFoundHttpException
     * @return string Path to the archive.
     */
    protected function get()
    {
        $zip = "{$this->getPackage()->getDistDir()}/{$this->getVersion()}.zip";

        if (!Storage::exists($zip)) {
            $dependency = "{$this->getPackage()->full_name}:{$this->getVersion()}";
            throw new NotFoundHttpException("Distributable archive for $dependency package not found.");
        }

        return storage_path("app/$zip");
    }
}
