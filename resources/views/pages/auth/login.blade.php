@extends('layouts.app')
@section('title', 'Login')

@section('content')
    <h1>Login</h1>

    @component('form', ['method' => 'post', 'action' => route('login')])
        @component('form.string', ['name' => 'email', 'autofocus' => true])
            E-mail:
        @endcomponent

        @component('form.password', ['name' => 'password'])
            Password:
        @endcomponent

        @component('form.checkbox', ['name' => 'remember'])
            Remember me
        @endcomponent

        @component('form.submit')
            Login
        @endcomponent

        <a href="{{ route('password.request') }}">
            Forgot Your Password?
        </a>
    @endcomponent
@endsection
