<div>
    <label>
        <input type="checkbox" name="{{ $name }}"
                {{ isset($disabled) && $disabled ? 'disabled' : '' }}
                {{ old($name, $default ?? null) ? 'checked' : '' }}>
        {{ $slot }}
    </label>
</div>
