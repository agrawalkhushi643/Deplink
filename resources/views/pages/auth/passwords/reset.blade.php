@extends('layouts.app')
@section('title', 'Reset Password')

@section('content')
    <h1>Reset Password</h1>

    @component('form', ['method' => 'post', 'action' => route('password.request')])
        @component('form.hidden', ['name' => 'token', 'value' => $token])
        @endcomponent

        @component('form.string', ['name' => 'email', 'autofocus' => true])
            E-Mail:
        @endcomponent

        @component('form.password', ['name' => 'password'])
            Password:
        @endcomponent

        @component('form.password', ['name' => 'password_confirmation'])
            Confirm password:
        @endcomponent

        @component('form.submit')
            Reset Password
        @endcomponent
    @endcomponent
@endsection
