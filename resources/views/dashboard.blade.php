<?php

$backlog = Auth::user()->backlog->backlog;

?>

<x-layout>

    <h2 class="text-blue font-serif text-mega text-center mt-12">
        Welcome back, {{ Auth::user()->name }}
    </h2>

    <div class="mt-6"></div>

    <div class="flex justify-between mx-40 items-center">
        <form action="" class="text-white">
            <x-search-bar />
        </form>
        <div class="flex items-center pb-2 space-x-4">
            <x-primary-button>Watchlist</x-primary-button>
            <x-primary-button>History</x-primary-button>
        </div>
    </div>

    <hr class='border-white border-opacity-25 mx-40 my-3'>

    <div class="grid grid-cols-6 mx-40">
        <div class="col-span-5 grid grid-cols-6 text-white">
            <p>date added</p>
            <p class="col-span-2">content</p>
            <p>released</p>
            <p>runtime</p>
        </div>
        <div class="text-white flex justify-end space-x-5">
            <p>like</p>
            <p>edit</p>
        </div>
    </div>

    <hr class='border-white border-opacity-25 mx-40 my-3'>

    @foreach ($backlog as $content)
        <x-content-row :content='$content'/>
    @endforeach

    <div class="mb-24"></div>

</x-layout>
