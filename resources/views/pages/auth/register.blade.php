@extends('layouts.app')
@section('title', 'Register Account')

@section('content')
    <h1>Register</h1>

    @component('form', ['method' => 'post', 'action' => route('register')])
        @component('form.string', ['name' => 'name', 'autofocus' => true])
            Username:
        @endcomponent

        @component('form.string', ['name' => 'email'])
            E-mail:
        @endcomponent

        @component('form.password', ['name' => 'password'])
            Password:
        @endcomponent

        @component('form.password', ['name' => 'password_confirmation'])
            Confirm password:
        @endcomponent

        @component('form.submit')
            Register
        @endcomponent
    @endcomponent
@endsection
