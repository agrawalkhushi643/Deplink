@extends('layouts.app')
@section('title', "Edit {$package->fullName}")

@section('content')
    <h1>Edit {{ $package->fullName }}</h1>

    @component('form', ['method' => 'put', 'action' => route('packages.update', [$package->org, $package->name])])
        @component('form.string', ['name' => 'org', 'default' => Auth::user()->name, 'disabled' => true])
            Organization:
        @endcomponent

        @component('form.string', ['name' => 'name', 'default' => $package->name, 'autofocus' => true])
            Name:
        @endcomponent

        @component('form.submit')
            Edit
        @endcomponent
    @endcomponent
@endsection
