<div>
    <a href="{{ route('packages.index') }}">Packages</a>

    <span class="profile">
        @auth
            @component('form.link', ['action' => route('logout')])
                Logout
            @endcomponent
        @else
            <a href="{{ route('login') }}">Sign in</a>
            @if(config('auth.sign_up.enabled', false))
                <a href="{{ route('register') }}">Sign up</a>
            @endif
        @endauth
    </span>
</div>
