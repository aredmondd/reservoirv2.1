<?php

use Illuminate\Support\Facades\Auth;

$friendRequests = Auth::user()->pending_friend_requests;
$reccomendations = Auth::user()->recommended_content;

?>

<nav x-data="{ open: false }" class="bg-midnight">
    <!-- Primary Navigation Menu -->
    <div class="mx-12">
        <div class="flex justify-between h-16">
            <div class="flex space-x-6">
                <!-- Navigation Links -->
                <div class="hidden ml-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->is('dashboard')">
                        Reservoir
                    </x-nav-link>
                </div>

                <div class="hidden ml-8 sm:flex">
                    <x-nav-link :href="route('my-profile')" :active="request()->is('my-profile')">
                        Profile
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('my-stacks')" :active="request()->is('stacks')">
                        Stacks
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('my-friends') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->is('my-friends') ? 'border-aqua' : 'border-transparent hover:border-white hover:border-opacity-50 focus:outline-none focus:text-white focus:border-white focus:border-opacity-50 text-opacity-50' }} text-sm leading-5 text-white transition duration-150 ease-in-out">
                    Friends
                    </a>
                    @if ($friendRequests != null || $reccomendations != null)
                    <span class="mt-4 relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-aqua opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-aqua"></span>
                    </span>
                    @endif
                </div>

                <div class="hidden sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('discover')" :active="request()->is('discover')">
                        Discover
                    </x-nav-link>
                </div>
            </div>
            <!-- Add Content Button -->
            <div class="hidden sm:flex sm:items-center mr-8">

                <x-search-content-modal />

                <!-- Profile Icon & Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-white focus:outline-none transition ease-in-out duration-150 mt-1">
                            <div>
                                <img 
                                src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/default.png') }}" 
                                alt="Profile Picture" 
                                class="w-12 h-12 rounded-full object-cover object-center">
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Edit Profile
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Log Out
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
                Dashboard
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
                    Profile
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
