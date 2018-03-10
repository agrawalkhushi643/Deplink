<?php

namespace App\Http\Controllers\Web;

use App\Models\Package;
use App\Services\Commands\Packages\CreateCommand;
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
            'packages' => $packages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CreateCommand $command
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, CreateCommand $command)
    {
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
     * @param string $org
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function show($org, $name)
    {
        $package = Package::findBySlug($org, $name);

        return view('pages.packages.show', [
            'package' => $package,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $org
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function edit($org, $name)
    {
        $package = Package::findBySlug($org, $name);

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $org
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $org, $name)
    {
        $package = Package::findBySlug($org, $name);

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $org
     * @param string $name
     * @return \Illuminate\Http\Response
     */
    public function destroy($org, $name)
    {
        $package = Package::findBySlug($org, $name);

        //
    }
}
