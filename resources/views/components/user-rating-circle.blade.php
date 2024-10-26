@props(['percent'])

@php
    $radius = 40;  // Radius of the circle
    $circumference = 2 * M_PI * $radius;  // Circumference formula
    $offset = $circumference - ($circumference * $percent / 100);  // Offset calculation based on $percent
@endphp

<div class="relative flex items-center justify-center w-32 h-32">
    <svg class="w-32 h-32">
        <!-- Background Circle -->
        <circle
            cx="50%"
            cy="50%"
            r="{{ $radius }}"
            fill="#050d14"
            stroke-width="18"
            stroke="currentColor"
        />

        <!-- Progress Circle -->
        <circle
            cx="50%"
            cy="50%"
            r="{{ $radius }}"
            fill="none"
            stroke-width="10"
            stroke-dasharray="{{ $circumference }}"
            stroke-dashoffset="{{ $offset }}"
            class="text-blue"
            stroke-linecap="round"
            stroke="currentColor"
        />
    </svg>

    <!-- Centered Percent Label -->
    <div class="absolute inset-0 flex items-center justify-center text-body text-white">
        {{ $percent }}%
    </div>
</div>