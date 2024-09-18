<div class="pt-24"></div>
<p class="text-center text-white opacity-50 font-sans text-small mb-10">Reservoir is a project created, designed, and developed by Aiden Redmond, Axel Beaver, and Brandon Wilson under the supervision of Dr. Roberson at Florida Southern College for Senior Project 24-25.</p>

<hr class="border-white border-opacity-25 mx-10 my-5">

<div class="grid grid-cols-3 m-10 items-center">
    @if (request()->is('/'))
        <a href="/" onclick="scrollToTop(event)" class="focus:outline-none bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text font-serif text-title">Reservoir</a> 
    @else
        <a href="/" class="focus:outline-none bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text font-serif text-title">Reservoir</a> 
    @endif
    <div class="flex text-center text-white text-body">
        @if (request()->is('/'))
            <a href="#" onclick="scrollToTop(event)" class="grow transition-colors duration-500 focus:outline-none focus:text-blue hover:text-blue">Home</a>
        @else
            <a href="/" class="grow transition-colors duration-500 focus:outline-none focus:text-blue hover:text-blue">Home</a>
        @endif
        <a href="/register" class="grow transition-colors duration-500 focus:outline-none focus:text-blue hover:text-blue">Register</a>
        <a href="/signin" class="grow transition-colors duration-500 focus:outline-none focus:text-blue hover:text-blue">Sign In</a>
        <a href="/about" class="grow transition-colors duration-500 focus:outline-none focus:text-blue hover:text-blue">About</a>
    </div>
    <div class="flex flex-row-reverse">
        <a href="https://github.com/axbeaver" target="_blank"><img class="w-16 h-16 rounded-full ml-3"src="images/beaver.JPG" alt="axel beaver headshot"></a>
        <a href="https://github.com/bdubbs11" target="_blank"><img class="w-16 h-16 rounded-full ml-3"src="images/wilson.JPG" alt="brandon wilson headshot"></a>
        <a href="https://github.com/aredmondd" target="_blank"><img class="w-16 h-16 rounded-full ml-3"src="images/redmond.JPG" alt="aiden redmond headshot"></a>
    </div>
</div>

<!-- This JavaScript scroll method was designed by Aiden Redmond & ChatGPT -->
<script>
    function scrollToTop(event) {

        event.preventDefault();

        const duration = 1000;
        const start = window.scrollY;
        const startTime = performance.now();

        function animateScroll(currentTime) {
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            const ease = progress < 0.5 ? 2 * progress * progress : -1 + (4 - 2 * progress) * progress;

            window.scrollTo(0, start * (1 - ease));

            if (timeElapsed < duration) {
                requestAnimationFrame(animateScroll);
            }
        }

        requestAnimationFrame(animateScroll);
    }
</script>