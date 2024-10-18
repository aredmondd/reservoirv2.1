<nav>
  <div class="flex flex-wrap items-center justify-between p-4">
    <a href="/" class="focus:outline-none bg-gradient-to-r from-blue to-aqua text-transparent bg-clip-text font-serif text-title">Reservoir</a> 
    <div class="flex items-center text-white">
      <form action="{{ route('search-results') }}" method="GET" class="mr-4">
          <input 
              type="text" 
              name="query" 
              placeholder="Search movies..." 
              class="px-4 py-2 text-black rounded focus:outline-none"
              required
          />
          <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded">Search</button>
      </form>
      
        <a class="{{ request()->is('about') ? 'text-blue' : '' }} mx-5 text-right focus:outline-none focus:text-blue hover:text-blue transition-colors duration-250 text-body mr-4" href="/about">About</a>
        <a class="{{ request()->is('register') ? 'text-blue' : '' }} ml-5 text-right focus:outline-none focus:text-blue hover:text-blue transition-colors duration-250 text-body mr-4" href="/register">Register</a>
        <a class="{{ request()->is('login') ? 'text-blue' : '' }} mx-5 text-right focus:outline-none focus:text-blue hover:text-blue transition-colors duration-250 text-body mr-4" href="/login">Login</a>
    </div>
  </div>
</nav>