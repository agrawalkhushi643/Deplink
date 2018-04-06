<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Services\Queries\Packages\DownloadQuery;
use App\Services\Queries\Packages\ExistsQuery;
use App\Services\Queries\Packages\PackageJsonQuery;

class PackageController extends Controller
{
    /**
     * @param ExistsQuery $query
     * @param string $org
     * @param string $package
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(ExistsQuery $query, $org, $package)
    {
        $exists = $query->setOrg($org)
            ->setName($package)
            ->run();

        return response()->json([
            'data' => [
                'exists' => $exists,
            ],
        ]);
    }

    /**
     * @param PackageJsonQuery $query
     * @param string $org
     * @param string $package
     * @param string $version
     * @return \Illuminate\Http\JsonResponse
     */
    public function metadata(PackageJsonQuery $query, $org, $package, $version)
    {
        $package = Package::findBySlug($org, $package);
        $json = $query->setPackage($package)
            ->setVersion($version)
            ->run();

        return response()->json([
            'data' => $json,
        ]);
    }

    /**
     * @param DownloadQuery $query
     * @param string $org
     * @param string $package
     * @param string $version
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(DownloadQuery $query, $org, $package, $version)
    {
        $package = Package::findBySlug($org, $package);
        $file = $query->setPackage($package)
            ->setVersion($version)
            ->run();

        $filename = str_replace('/', '-', "{$package->full_name}-$version.zip");
        return response()->download($file, $filename);
    }
}
