<nav>
  <div class="flex items-center justify-between py-4 mx-12">
    <a href="/" class="focus:outline-none bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text font-serif text-title">Reservoir</a> 
    <div class="flex space-x-8 items-end text-white">
        <a class="{{ request()->is('about') ? 'text-blue' : '' }} text-right focus:outline-none focus:text-blue hover:text-blue transition-colors duration-250 text-body" href="/about">About</a>
        <a class="{{ request()->is('register') ? 'text-blue' : '' }} text-right focus:outline-none focus:text-blue hover:text-blue transition-colors duration-250 text-body" href="/register">Register</a>
        <a class="{{ request()->is('login') ? 'text-blue' : '' }} text-right focus:outline-none focus:text-blue hover:text-blue transition-colors duration-250 text-body" href="/login">Login</a>
    </div>
  </div>
</nav>