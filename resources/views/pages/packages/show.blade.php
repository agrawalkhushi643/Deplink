@extends('layouts.app')
@section('title', $package->fullName)

@section('content')
    <h1>{{ $package->fullName }}</h1>
@endsection
