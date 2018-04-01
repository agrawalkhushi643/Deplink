<?php

namespace App\Http\Controllers\Web;

use App\Models\Package;
use App\Services\Commands\Packages\CreateCommand;
use App\Services\Commands\Packages\DeleteCommand;
use App\Services\Commands\Packages\RenameCommand;
use App\Services\Queries\Packages\VersionsQuery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index', 'show'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::orderBy('name')->paginate();

        return view('pages.packages.index', [
            'packages' => $packages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Package::class);

        return view('pages.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CreateCommand $command
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, CreateCommand $command)
    {
        $this->authorize('create', Package::class);

        $org = Auth::user()->name;
        $name = $request->input('name');

        $command->setOrg($org)
            ->setName($name)
            ->setOwner(Auth::user())
            ->run();

        return redirect()->route('packages.index')
            ->with('status', "Package $org/$name has been successfully created.");
    }

    /**
     * Display the specified resource.
     *
     * @param VersionsQuery $query
     * @param string $org
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function show(VersionsQuery $query, $org, $name)
    {
        $package = Package::findBySlug($org, $name);
        $versions = $query->setPackage($package)->run();

        return view('pages.packages.show', [
            'package' => $package,
            'versions' => $versions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $org
     * @param string $name
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($org, $name)
    {
        $package = Package::findBySlug($org, $name);
        $this->authorize('update', $package);

        return view('pages.packages.edit', [
            'package' => $package,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param RenameCommand $command
     * @param string $org
     * @param string $name
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, RenameCommand $command, $org, $name)
    {
        $package = Package::findBySlug($org, $name);
        $this->authorize('update', $package);

        $oldName = $package->name;
        $newName = $request->input('name');

        $command->setPackage($package)
            ->setNewName($newName)
            ->run();

        return redirect()->route('packages.show', [$org, $newName])
            ->with('status', "Package $org/$oldName has been renamed to $org/$newName.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $org
     * @param string $name
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function destroy(DeleteCommand $command, $org, $name)
    {
        $package = Package::findBySlug($org, $name);
        $this->authorize('delete', $package);

        $command->setPackage($package)
            ->run();

        return redirect()->route('packages.index')
            ->with('status', "Package $org/$name has been deleted.");
    }
}
