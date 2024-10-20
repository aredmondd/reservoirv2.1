<x-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="mt-14">
        <h1 class="text-center font-serif text-mega text-blue mb-10">Back to the flow</h1>
        <div class="flex flex-col justify-center">
            <div class="mt-auto sm:mx-auto sm:w-full sm:max-w-sm">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <!-- Email Address -->
                    <div>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  placeholder="Email" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-text-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        placeholder="Password"
                                        required autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="text-center mt-6">
                        <button type="submit" class="text-midnight rounded-full bg-blue p-3 px-10 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>