<nav>
  <div class="flex flex-wrap items-center justify-between p-4">
    <a href="/" class="focus:outline-none bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text font-serif text-title">Reservoir</a> 
    <div class="flex items-center text-white">
        <x-search-bar></x-search-bar>
        <a class="{{ request()->is('register') ? 'text-light-blue' : '' }} ml-5 text-right focus:outline-none focus:text-blue" href="/register">Register</a>
        <a class="{{ request()->is('signin') ? 'text-light-blue' : '' }} mx-5 text-right focus:outline-none focus:text-blue" href="/signin">Sign In</a>
    </div>
  </div>
</nav>