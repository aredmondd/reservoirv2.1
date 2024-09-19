<!-- scroll animation idea and partial code from https://cruip.com/create-an-infinite-horizontal-scroll-animation-with-tailwind-css/ -->
<div class="w-full inline-flex flex-nowrap [mask-image:_linear-gradient(to_right,transparent_0,white,blue,transparent_100%)] group">
    <ul class="flex animate-loop-scroll group-hover:paused">
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
    </ul>
    <ul class="flex animate-loop-scroll group-hover:paused" aria-hidden="true">
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
            <x-movie-card img="images/Lobster.jpg"></x-movie-card>
    </ul>
</div>