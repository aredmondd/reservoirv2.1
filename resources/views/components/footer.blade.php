<p class="text-center text-white opacity-50 font-sans text-sm mb-10">Reservoir is a project created, designed, and developed by Aiden Redmond, Brandon Wilson, and Axel Beaver under the supervision of Dr. Roberson at Florida Southern College for Senior Project Fall 2025.</p>

<hr class="border-white border-opacity-25 mx-12">

<div class="grid {{ Auth::guest() ? 'grid-cols-3' : 'grid-cols-4'; }} mx-12 mb-12 mt-10 items-center">
    <a href="/" class="focus:outline-none bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text font-serif text-title">Reservoir</a> 

    <div class="{{ Auth::guest() ? '' : 'col-span-2'; }}">
        <div class="flex text-center text-white text-body">
            @if(Auth::guest())
                <a href="/register" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Register</a>
                <a href="/login" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Sign In</a>
            @else
                <a href="/dashboard" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Reservoir</a>
                <a href="/stacks" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Profile</a>
                <a href="/stacks" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Stacks</a>
                <a href="/my-friends" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Friends</a>
                <a href="/discover" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Discover</a>
            @endif
            <a href="/about" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">About</a>
        </div>
    </div>

    <div class="flex flex-row-reverse">
        <a href="https://github.com/axbeaver" target="_blank"><img class="w-16 h-16 rounded-full ml-3"src="../../images/beaver.JPG" loading="lazy" alt="axel beaver headshot"></a>
        <a href="https://github.com/bdubbs11" target="_blank"><img class="w-16 h-16 rounded-full ml-3"src="../../images/wilson.JPG" loading="lazy" alt="brandon wilson headshot"></a>
        <a href="https://github.com/aredmondd" target="_blank"><img class="w-16 h-16 rounded-full ml-3"src="../../images/redmond.JPG" loading="lazy" alt="aiden redmond headshot"></a>
    </div>
</div>