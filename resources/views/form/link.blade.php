<form method="{{ isset($method) && $method === 'get' ? 'get' : 'post' }}" action="{{ $action }}">
    @method($method ?? 'post')
    @csrf

    <button type="submit">{{ $slot }}</button>
</form>
