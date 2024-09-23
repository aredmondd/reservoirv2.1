@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-aqua text-sm leading-5 text-white focus:outline-none focus:border-aqua transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm leading-5 text-white text-opacity-50 hover:border-white hover:border-opacity-50 focus:outline-none focus:text-white focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
