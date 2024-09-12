<nav class="grid grid-cols-12 text-white m-3 items-center">
    <a href="/" class="col-span-8 focus:outline-none bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text font-serif text-title">Reservoir</a> 
    <x-search-bar></x-search-bar>
    <a class="{{ request()->is('register') ? 'text-light-blue' : '' }} ml-5 text-right focus:outline-none focus:text-blue" href="/register">Register</a>
    <a class="{{ request()->is('signin') ? 'text-light-blue' : '' }} mx-5 text-right focus:outline-none focus:text-blue" href="/signin">Sign In</a>
</nav>