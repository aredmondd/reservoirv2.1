<x-layout>
    @if ($fresh == true)
    <div id="successNotification" class="fixed top-[-100px] left-1/2 transform -translate-x-1/2 bg-blue text-white py-2 px-4 rounded-md z-[1000] text-center shadow-lg animate-slideIn">
        <div class="text-base">
            Successfully created stack: '{{ $stackTitle }}'
        </div>
    </div>
    @endif

    <div class="flex justify-between items-end mx-40">
        <div class="flex flex-col items-start">
            <h1 class="text-blue text-mega font-serif mt-12 text-center max-w-5xl">{{ $stackTitle }}</h1>
            <p class="text-white text-center text-body">{{ $stackDescription }}</p>
        </div>

        <div class="flex flex-col space-y-6 mt-6 items-end">
            <button><img src="images/edit.png" alt="" class="w-8"></button>
            <form action="/stack?id={{ request('id') }}" method="POST" class="h-8">
                @csrf
                @method('DELETE')
                <button type="submit"><img src="images/delete.png" alt="Delete" class="w-8"></button>
            </form>
        </div>

    </div>

    <x-hr class="mt-12" />

    <div class="flex space-x-8 justify-center">
        <x-stack-movie-poster img="images/movie_posters/parasite.jpg" name="Parasite"/>
        <x-stack-movie-poster img="images/movie_posters/batman.png" name="The Batman"/>
        <x-stack-movie-poster img="images/movie_posters/Lobster.jpg" name="The Lobster"/>
        <x-stack-movie-poster img="images/movie_posters/joker.jpeg" name="The Joker"/>
    </div>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var successNotification = document.getElementById('successNotification');

        if (successNotification) {
            setTimeout(function() {
                successNotification.style.opacity = '0'; // Fade out the notification
                successNotification.style.animation = 'slideOut 0.5s ease forwards'; // Trigger slide-out animation
                setTimeout(function() {
                    successNotification.remove();
                }, 500); // Wait for the slide-out animation to finish before removing the notification
            }, 4000); // Hide the notification after 4000 milliseconds (4 seconds)
        }
    });
</script>