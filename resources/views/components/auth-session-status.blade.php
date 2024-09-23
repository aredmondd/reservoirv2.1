@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-sm text-aqua']) }}>
        {{ $status }}
    </div>
@endif
