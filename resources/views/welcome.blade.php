<x-layout>
    <div class="px-40 mx-40 my-20 text-center">
        <h1 class="text-mega font-serif text-white">The place to <span class="bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text">collect, track, and discover</span> your media.</h1>
    </div>

    <div class="grid grid-cols-2 grid-rows-2 mx-40 text-white">
        <div class="border border-blue p-24">
            Track movies you want to watch
        </div>
        <div class="border border-white">  
            Track movies you have watched
        </div>
        <div class="border border-white">  
            Track your favorites
        </div>
        <div class="border border-blue">  
            Share with others
        </div>
    </div>

    <div class="my-20"></div>

    <h1 class="text-white font-serif text-mega text-center">Meet Ripple</h1>
    <div class="border border-white border-opacity-25 p-10 rounded-md mx-40 flex items-center mt-12">
        
    </div>

    <div class="my-20"></div>

    <h1 class="text-white font-serif text-mega text-center">What people are watching</h1>
    <div class="flex flex-wrap justify-between items-center mx-28 mt-12 text-white">
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
    </div>

    <div class="my-20"></div>

    <h1 class="text-white font-serif text-mega text-center">In theatres</h1>
    <div class="flex flex-wrap justify-between items-center mx-28 mt-12 text-white">
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
    </div>

    <div class="my-20"></div>

    <h1 class="text-white font-serif text-mega text-center">Top rated movies</h1>
    <div class="flex flex-wrap justify-between items-center mx-28 mt-12 text-white">
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
        <x-movie-card>Movie Title</x-movie-card>
    </div>

    <div class="px-40 mt-20 text-center">
        <h1 class="text-mega font-serif text-white">Create your <span class="bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text">Reservoir</span> today</h1>
        <div class="mt-10"></div>
        <a href="/register"><button class="text-midnight rounded-full bg-blue p-3 px-10 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Register</button></a>
        <div class="inline mt-5 mr-5"></div>
        <a href="/signin"><button class="text-midnight rounded-full bg-blue p-3 px-10 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Sign In</button></a>
    </div>
</x-layout>