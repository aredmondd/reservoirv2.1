@props(['actor'])

<div class="flex-none w-[180px]">
    <div class="flex flex-col">
        <img src="{{ $actor['profile_path'] ? 'https://image.tmdb.org/t/p/w500' . $actor['profile_path'] : asset('images/no-movie-poster.jpg') }}" alt="{{ $actor['name'] }} profile picture" class="rounded-lg min-w-[20%]">
        <h3 class="text-white text-body">{{ $actor['name'] }}</h3>
        <h3 class="text-white text-sm text-opacity-50">{{ $actor['character'] }}</h3>
    </div>
</div>