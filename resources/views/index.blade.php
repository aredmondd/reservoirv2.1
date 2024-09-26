<x-layout>
    <div class="mt-12"></div>

    <!-- Ad #1 -->
    <div class="px-40 mt-20 text-center">
        <h1 class="text-mega font-serif text-white">Create your <span class="bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text">Reservoir</span> today</h1>
        <p class="text-white text-opacity-50 text-body font-sans">We’re building a space to curate, track, and discover your media journey, <br> where personalized recommendations flow with your unique tastes.</p>
        <div class="mt-6"></div>
        <a href="/register"><button class="text-midnight rounded-full bg-blue p-3 px-10 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Register</button></a>
        <div class="inline mt-5 mr-5"></div>
        <a href="/login"><button class="text-midnight rounded-full bg-blue p-3 px-10 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Sign In</button></a>
    </div>

    <div class="mt-32"></div>

    <!-- Track -->
    <h2 class="font-serif text-mega text-center text-white mb-6">Add & track your media</h2>
    <hr class="border-white border-opacity-25 mx-40 mb-12">
    <p class="text-white text-body font-sans text-opacity-50 text-center mb-12">Discover your favorites, explore trending films, and dive into a world of <span class="text-aqua">cinematic gems</span>.</p>
    <div class="flex mx-36 justify-around">
        <x-add-movie-ad img="images/movie_posters/parasite.jpg" name="Parasite" desc="Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan."></x-add-movie-ad>
        <x-add-movie-ad img="images/movie_posters/batman.png" name="The Batman" desc="When a sadistic serial killer begins murdering key political figures in Gotham, The Batman is forced to investigate the city's hidden corruption and question his family's involvement."></x-add-movie-ad>
        <x-add-movie-ad img="images/movie_posters/Lobster.jpg" name="The Lobster" desc="In a dystopian near future, according to the laws of The City, single people are taken to The Hotel, where they are obliged to find a romantic partner in 45 days or they're transformed into beasts and sent off into The Woods."></x-add-movie-ad>
    </div>

    <div class="mt-32"></div>

    <!-- Discover -->
    <h2 class="font-serif text-mega text-center text-white mb-6">Discover with <span class="text-aqua">Ripple</span></h2>
    <hr class="border-white border-opacity-25 mx-40 mb-12">
    <p class="text-white text-body font-sans text-opacity-50 text-center mb-12">As you rate movies, <span class="text-aqua">Ripple</span>, an advanced AI model, creates a personalized recommendation list based on what you like and dislike.</p>
    <x-baloons></x-baloons>

    <div class="mt-32"></div>

    <!-- Rate & Organize -->
    <h2 class="font-serif text-mega text-center text-white mb-6">Organize your media with <span class="text-aqua">Stacks</span></h2>
    <hr class="border-white border-opacity-25 mx-40 mb-12">
    <p class="text-white text-body font-sans text-opacity-50 text-center mb-12">Create custom stacks to highlight your favorite movies by genre, decade, or any theme you choose, showcasing your unique cinematic tastes.</p>
    <div class="flex justify-between mx-40">
        <x-movie-stack />
        <x-movie-stack />
        <x-movie-stack />
    </div>


    <div class="mt-32"></div>

    <!-- Popular Movies Scroller -->
    <h1 class="text-white font-serif text-mega text-center mb-12">Check out Popular Movies</h1>

    <div class="mt-12"></div>

    <!-- Recently Released Movies Scroller -->
    <h1 class="text-white font-serif text-mega text-center mb-12">Recently Released Movies</h1>

    <div class="mt-12"></div>

    <!-- Ad #2 -->
    <div class="px-40 mt-20 text-center">
        <h1 class="text-mega font-serif text-white">Ready to dive in?</h1>
        <div class="mt-6"></div>
        <a href="/register"><button class="text-midnight rounded-full bg-blue p-3 px-16 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Register</button></a>
        <div class="inline mt-5 mr-5"></div>
        <a href="/login"><button class="text-midnight rounded-full bg-blue p-3 px-16 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Sign In</button></a>
    </div>
</x-layout>