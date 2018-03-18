<?php

namespace App\Http\Controllers\Api\V1\Packages;

use App\Models\Package;
use App\Services\Queries\Packages\VersionsQuery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VersionController extends Controller
{
    public function index(VersionsQuery $query, $org, $package)
    {
        $package = Package::findBySlug($org, $package);
        $versions = $query->setPackage($package)->run();

        return response()->json([
            'data' => $versions,
        ]);
    }
}
