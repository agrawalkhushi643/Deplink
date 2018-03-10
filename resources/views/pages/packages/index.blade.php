@extends('layouts.app')
@section('title', 'Packages')

@section('content')
    <h1>Packages</h1>

    <div>
        <a href="{{ route('packages.create') }}"> Create </a>
    </div>

    <ul>
        @foreach($packages as $package)
            <li>
                <a href="{{ route('packages.show', [$package->org, $package->name]) }}">
                    {{ $package->org }}/{{ $package->name }}
                </a>
            </li>
        @endforeach
    </ul>

    {{ $packages->links() }}
@endsection
