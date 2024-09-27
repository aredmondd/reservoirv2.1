<x-layout>
    <form method="POST" action="{{ route('register') }}">
        <div class="mt-14">
            <h1 class="text-center font-serif text-mega text-blue mb-10">Ready to dive in?</h1>
            <div class="flex flex-col justify-center">
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-6" action="/register" method="POST">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder="Name" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Username -->
                        <div class="mt-4">
                            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" placeholder="Username" required autocomplete="username"/>
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required autocomplete="Email"/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            placeholder="Password"
                                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" 
                                            placeholder="Confirm Password"
                                            required autocomplete="new-password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <button type="submit" class="text-midnight rounded-full bg-blue p-3 px-10 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Register</button>
        </div>

        <p class="mt-8 text-center text-small text-white text-opacity-50">
        Already have an account?
        <a href="/login" class="underline">Sign in here</a>
        </p>
    </form>
</x-layout>