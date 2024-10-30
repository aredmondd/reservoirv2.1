<x-layout>
    <x-success-notification />
    <x-error-notification />

    <!-- Ad #1 -->
    <div class="px-40 mt-20 text-center">
        <h1 class="text-mega font-serif text-white">Create your <span class="bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text">Reservoir</span> today</h1>
        <p class="text-white text-opacity-50 text-body font-sans">We’re building a space to curate, track, and discover your media journey, <br> where personalized recommendations flow with your unique tastes.</p>
        <div class="mt-6"></div>
        <a href="/register"><button class="text-midnight rounded-full bg-blue p-3 px-10 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Register</button></a>
        <div class="inline mt-5 mr-5"></div>
        <a href="/login"><button class="text-midnight rounded-full bg-blue p-3 px-10 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Sign In</button></a>
    </div>

    <!-- Track -->
    <h2 class="font-serif text-mega text-center text-white mb-6 mt-32">Add & track your media</h2>
    <x-hr />
    <p class="text-white text-body font-sans text-opacity-50 text-center mb-12">Discover your favorites, explore trending films, and dive into a world of <span class="text-aqua">cinematic gems</span>.</p>
    <div class="flex mx-36 justify-around 3xl:mx-56">
        <x-add-content-ad :movieData='$leftMovie'></x-add-content-ad>
        <x-add-content-ad :movieData='$middleMovie'></x-add-content-ad>
        <x-add-content-ad :movieData='$rightMovie'></x-add-content-ad>
    </div>

    <!-- Discover -->
    <h2 class="font-serif text-mega text-center text-white mb-6 mt-32">Discover more with <span class="text-blue">Ripple</span></h2>
    <x-hr />
    <p class="text-white text-body font-sans text-opacity-50 text-center mb-12">As you rate movies, <span class="text-aqua">Ripple</span>, an advanced AI model, creates a personalized recommendation list based on what you like and dislike.</p>
    <x-ripple-ad />

    <!-- Rate & Organize -->
    <h2 class="font-serif text-mega text-center text-white mb-6 mt-32">Organize with <span class="text-aqua">Stacks</span></h2>
    <x-hr />
    <p class="text-white text-body font-sans text-opacity-50 text-center mb-12">Create custom stacks to highlight your favorite movies by genre, decade, or any theme you choose, showcasing your unique cinematic tastes.</p>
    <div class="flex justify-center ml-[-50px]">
        <div class="grid grid-cols-3 gap-x-32">
            <x-content-stack :stack='$aiden_stack' />
            <x-content-stack :stack='$brandon_stack' />
            <x-content-stack :stack='$axel_stack' />
        </div>
    </div>

    <h1 class="text-white font-serif text-mega text-center mb-12 mt-32">Popular Movies</h1>
    <x-card-scroller :movieData="$popularMovie" :flag=" 'movie' "></x-card-scroller>

    <h1 class="text-white font-serif text-mega text-center mb-12 mt-32">Popular TV Shows</h1>
    <!-- in theater movies  -->
    <x-card-scroller :movieData="$topRatedTVShows" :flag=" 'tv' "></x-card-scroller>
   

    <!-- Ad #2 -->
    <div class="px-40 my-32 text-center">
        <h1 class="text-mega font-serif text-white">Ready to dive in?</h1>
        <div class="mt-6"></div>
        <a href="/register"><button class="text-midnight rounded-full bg-blue p-3 px-16 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Register</button></a>
        <div class="inline mt-5 mr-5"></div>
        <a href="/login"><button class="text-midnight rounded-full bg-blue p-3 px-16 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Sign In</button></a>
    </div>
</x-layout>