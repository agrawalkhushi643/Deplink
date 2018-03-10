<form method="post" action="{{ $action }}">
    @csrf

    <button type="submit">{{ $slot }}</button>
</form>
