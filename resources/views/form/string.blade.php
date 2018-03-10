<div>
    <label>
        {{ $slot }}
        <input type="text" name="{{ $name }}" value="{{ old($name, $default ?? null) }}"
                {{ isset($disabled) && $disabled ? 'disabled' : '' }}
                {{ isset($autofocus) && $autofocus ? 'autofocus' : '' }}>
    </label>

    @if($errors->has($name))
        <div>{{ $errors->first($name) }}</div>
    @endif
</div>
