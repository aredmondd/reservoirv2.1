@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-white text-opacity-25']) }}>
    {{ $value ?? $slot }}
</label>
