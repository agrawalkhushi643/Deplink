@extends('layouts.app')
@section('title', 'Request Password Reset')

@section('content')
    <h1>Request Password Reset</h1>

    @component('form', ['method' => 'post', 'action' => route('password.email', [], true)])
        @component('form.string', ['name' => 'email', 'autofocus' => true])
            E-Mail:
        @endcomponent

        @component('form.submit')
            Send Password Reset Link
        @endcomponent
    @endcomponent
@endsection
