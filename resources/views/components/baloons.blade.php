<!-- resources/views/components/movie-recommendation.blade.php -->
<div class="relative flex flex-col justify-center items-center text-white">
    <!-- Main Movie Poster -->
    <img src="images/movie_posters/polt.jpg" alt="Main Movie Poster" class="w-64 h-auto rounded-md transform transition-transform duration-300 hover:scale-105">

    <!-- Lines and Recommended Movies (balloon-style) -->
    <div class="absolute flex flex-col justify-center space-y-4 z-[-1]">
        <div class="relative">
            <div class="absolute h-0.5 w-64 bg-white bg-opacity-50 transform origin-left rotate-[-30deg] left-32"></div>
        </div>

        <div class="relative">
            <div class="absolute h-0.5 w-48 bg-white bg-opacity-50 transform origin-left rotate-[-15deg] left-32"></div>
        </div>

        <div class="relative">
            <div class="absolute h-0.5 w-72 bg-white bg-opacity-50 transform origin-left rotate-[10deg] left-32"></div>
        </div>

        <div class="relative">
            <div class="absolute h-0.5 w-44 bg-white bg-opacity-50 transform origin-left rotate-[30deg] left-32"></div>
        </div>
    </div>
</div>

<div class="flex justify-center items-center mt-8">
    <img src="images/star.png" alt="star" class="w-8 mx-1">
    <img src="images/star.png" alt="star" class="w-8 mx-1">
    <img src="images/star.png" alt="star" class="w-8 mx-1">
    <img src="images/star.png" alt="star" class="w-8 mx-1">
    <img src="images/star.png" alt="star" class="w-8 mx-1">
</div>



<!-- <img src="images/movie_posters/jaws.jpg" alt="Recommended Movie 1" class="w-24 h-auto shadow-lg rounded-lg">
<img src="images/movie_posters/opp.avif" alt="Recommended Movie 2" class="w-24 h-auto shadow-lg rounded-lg">
<img src="images/movie_posters/TNBC.webp" alt="Recommended Movie 3" class="w-24 h-auto shadow-lg rounded-lg">
<img src="images/movie_posters/SOTL.jpg" alt="Recommended Movie 4" class="w-24 h-auto shadow-lg rounded-lg"> -->