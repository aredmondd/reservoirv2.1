<x-layout>
    <div class="flex justify-between items-end mx-32">
        <div class="flex flex-col items-start">
            <h1 class="text-blue text-mega font-serif mt-12 text-center">Stack Name</h1>
            <p class="text-white text-center text-body">Stack description</p>
        </div>

        <div class="space-x-4 mt-6">
            <button class="border border-white rounded-full px-3 p-2 text-white">Gallery View</button>
            <button class="border border-white rounded-full px-3 p-2 text-white">List View</button>
        </div>
    </div>

    <div class="mt-24"></div>

    <div class="flex space-x-8 justify-center">
        <x-stack-movie-poster img="images/movie_posters/parasite.jpg" name="Parasite"/>
        <x-stack-movie-poster img="images/movie_posters/batman.png" name="The Batman"/>
        <x-stack-movie-poster img="images/movie_posters/Lobster.jpg" name="The Lobster"/>
        <x-stack-movie-poster img="images/movie_posters/opp.avif" name="Oppenheimer"/>
        <x-stack-movie-poster img="images/movie_posters/joker.jpeg" name="The Joker"/>
    </div>

    <div class="flex space-x-8 justify-center">
        <x-stack-movie-poster img="images/movie_posters/parasite.jpg" name="Parasite"/>
        <x-stack-movie-poster img="images/movie_posters/batman.png" name="The Batman"/>
        <x-stack-movie-poster img="images/movie_posters/Lobster.jpg" name="The Lobster"/>
        <x-stack-movie-poster img="images/movie_posters/opp.avif" name="Oppenheimer"/>
        <x-stack-movie-poster img="images/movie_posters/joker.jpeg" name="The Joker"/>
    </div>

    <div class="flex space-x-8 justify-center">
        <x-stack-movie-poster img="images/movie_posters/parasite.jpg" name="Parasite"/>
        <x-stack-movie-poster img="images/movie_posters/batman.png" name="The Batman"/>
        <x-stack-movie-poster img="images/movie_posters/Lobster.jpg" name="The Lobster"/>
        <x-stack-movie-poster img="images/movie_posters/opp.avif" name="Oppenheimer"/>
        <x-stack-movie-poster img="images/movie_posters/joker.jpeg" name="The Joker"/>
    </div>
</x-layout>