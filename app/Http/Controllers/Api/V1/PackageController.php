<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Services\PackageFileBuilder;
use App\Services\Queries\Packages\DownloadQuery;
use App\Services\Queries\Packages\ExistsQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
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
