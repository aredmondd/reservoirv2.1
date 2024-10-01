<div class="pt-24"></div>
<p class="text-center text-white opacity-50 font-sans text-sm mb-10">Reservoir is a project created, designed, and developed by Aiden Redmond, Brandon Wilson, and Axel Beaver under the supervision of Dr. Roberson at Florida Southern College for Senior Project 24-25.</p>

<hr class="border-white border-opacity-25 mx-12 my-5">

<div class="grid grid-cols-{{ Auth::guest() ? 3 : 4; }} m-12 items-center">
    <a href="/" class="focus:outline-none bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text font-serif text-title">Reservoir</a> 

    <div class="flex text-center text-white text-body {{ Auth::guest() ? '' : 'col-span-2'; }}">
        @if(Auth::guest())
            <a href="/" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Home</a>
            <a href="/register" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Register</a>
            <a href="/login" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Sign In</a>
        @else
            <a href="/dashboard" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Dashboard</a>
            <a href="/my-reservoir" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">My Reservoir</a>
            <a href="/stacks" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">My Stacks</a>
            <a href="/discover" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">Discover</a>
        @endif
        <a href="/about" class="grow transition duration-150 ease-in-out focus:outline-none focus:text-blue hover:text-blue">About</a>
    </div>

    <div class="flex flex-row-reverse">
        <a href="https://github.com/axbeaver" target="_blank"><img class="w-16 h-16 rounded-full ml-3"src="../images/beaver.JPG" alt="axel beaver headshot"></a>
        <a href="https://github.com/bdubbs11" target="_blank"><img class="w-16 h-16 rounded-full ml-3"src="../images/wilson.JPG" alt="brandon wilson headshot"></a>
        <a href="https://github.com/aredmondd" target="_blank"><img class="w-16 h-16 rounded-full ml-3"src="../images/redmond.JPG" alt="aiden redmond headshot"></a>
    </div>
</div>