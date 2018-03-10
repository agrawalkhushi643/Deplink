<div>
    <a href="{{ route('packages.index') }}">Packages</a>

    @auth
        @component('form.link', ['action' => route('logout')])
            Logout
        @endcomponent
    @else
        <a href="{{ route('login') }}">Sign in</a>
        <a href="{{ route('register') }}">Sign up</a>
    @endauth
</div>
