<nav>
  <div class="flex flex-wrap items-center justify-between p-4">
    <a href="/" class="focus:outline-none bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text font-serif text-title">Reservoir</a> 
    <div class="flex items-center text-white">
        <x-search-bar></x-search-bar>
        <div class="mr-4"></div>
        <a class="{{ request()->is('register') ? 'text-blue' : '' }} ml-5 text-right focus:outline-none focus:text-blue hover:text-blue transition-colors duration-500 text-body" href="/register">Register</a>
        <div class="mr-4"></div>
        <a class="{{ request()->is('signin') ? 'text-blue' : '' }} mx-5 text-right focus:outline-none focus:text-blue hover:text-blue transition-colors duration-500 text-body" href="/signin">Sign In</a>
    </div>
  </div>
</nav>