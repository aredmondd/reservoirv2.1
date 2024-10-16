<nav x-data="{ open: false }" class="bg-midnight">
    <!-- Primary Navigation Menu -->
    <div class="mx-12">
        <div class="flex justify-between h-16">
            <div class="flex space-x-6">
                <!-- Navigation Links -->
                <div class="hidden ml-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->is('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('my-stacks')" :active="request()->is('stacks')">
                        {{ __('Stacks') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('discover')" :active="request()->is('discover')">
                        {{ __('Discover') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('search')" :active="request()->is('search')">
                        {{ __('Search') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Add Content Button -->
            <div class="hidden sm:flex sm:items-center mr-8">
                <button class="text-white border border-blue rounded-full px-4 py-2 mt-2 mr-4 hover:bg-blue transition ease-in-out duration-300" x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-content')">{{ __('Fill your Reservoir') }}</button>
                <x-modal name="add-content" :show="$errors->isNotEmpty()" focusable>
                    <form method="POST" action="{{ route('add-content') }}" class="p-6 bg-midnight">
                        @csrf

                        <h2 class="text-title font-serif text-white text-center">
                            {{ __('Search') }}
                        </h2>

                        <div class="mt-6">
                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="mt-1 block w-3/4 shadow-md"
                                placeholder="{{ __('Search Movies, TV Shows, & more...')}}"
                            />

                            <div class="container mx-auto p-8">
                                <div class="grid grid-cols-4 gap-6">
                                    <div class="bg-gray-800 p-4 rounded-lg">
                                        <img src="https://image.tmdb.org/t/p/w500movie['poster_path']" alt="movie['title']}}" class="rounded-lg mb-2">
                                        <h2 class="text-white text-lg">movie['title']</h2>
                                        <p class="text-white text-opacity-50">movie['release_date']</p>
                                    </div>

                                    <!-- if no movies are found -->
                                    <p class="text-white text-opacity-50">No movies found.</p>
                                </div>
                            </div>
                            
                            @if($errors->any())
                                <div class="text-red-600">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="mt-6 flex justify-between items-center">
                            <button type="button" x-on:click="$dispatch('close')" class="text-midnight bg-white rounded-full px-4 p-2 font-medium tracking-wide focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">Cancel</button>
                            <button type="submit "class="text-white bg-blue rounded-full px-4 p-2 font-medium tracking-wide focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">{{ __('Create new Stack') }}</button>
                        </div>
                    </form>
                </x-modal>

                <!-- Profile Icon & Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-white focus:outline-none transition ease-in-out duration-150 mt-1">
                            <div><img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/default.png') }}" alt="" class="w-12 h-12 rounded-full"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Edit Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-body text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
