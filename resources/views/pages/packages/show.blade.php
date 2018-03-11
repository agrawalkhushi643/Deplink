@extends('layouts.app')
@section('title', $package->fullName)

@section('content')
    <h1>{{ $package->fullName }}</h1>

    @can('update', $package)
        <a href="{{ route('packages.edit', [$package->org, $package->name]) }}">Edit</a>
    @endcan

    @can('delete', $package)
        @component('form.link', ['method' => 'delete', 'action' => route('packages.destroy', [$package->org, $package->name])])
            Delete
        @endcomponent
    @endcan

    <h2>Available versions:</h2>
    @foreach($package->artifacts as $artifact)
        <div>v{{ $artifact->version }} ({{ $artifact->platform }} {{ $artifact->arch }})</div>
    @endforeach

    @if($package->artifacts->isEmpty())
        No binaries uploaded.
    @endif

    <h2>Installation:</h2>
    <p>In order to use the package run a command below:</p>
    <code>deplink install {{ $package->fullName }}</code>
@endsection
