@extends('layouts.app')
@section('title', 'Create Package')

@section('content')
    <h1>Create Package</h1>

    @component('form', ['method' => 'post', 'action' => route('packages.store')])
        @component('form.string', ['name' => 'org', 'default' => Auth::user()->name, 'disabled' => true])
            Organization:
        @endcomponent

        @component('form.string', ['name' => 'name', 'autofocus' => true])
            Name:
        @endcomponent

        @component('form.submit')
            Create
        @endcomponent
    @endcomponent
@endsection
