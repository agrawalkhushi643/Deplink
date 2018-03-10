<div>
    <label>
        {{ $slot }}
        <input type="password" name="{{ $name }}"
                {{ isset($disabled) && $disabled ? 'disabled' : '' }}
                {{ isset($autofocus) && $autofocus ? 'autofocus' : '' }}>
    </label>

    @if($errors->has($name))
        <div>{{ $errors->first($name) }}</div>
    @endif
</div>
