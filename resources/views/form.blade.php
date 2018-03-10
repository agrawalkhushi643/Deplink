<form method="{{ $method === 'get' ? 'get' : 'post' }}" action="{{ $action }}">
    @method($method)
    @csrf

    {{ $slot }}
</form>
