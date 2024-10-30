<x-layout>
    <h1 class="text-white text-mega font-serif text-center mt-14">Forgot Password</h1>
    <p class="text-white text-sm text-opacity-50 text-center mb-14">Enter your email below to recieve a password reset email</p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="text-center sm:mx-auto sm:w-full sm:max-w-sm">
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-6 text-center">
            <button class="bg-slate rounded-full bg-opacity-25 text-white px-6 py-3 hover:bg-opacity-50 transition-all duration-250">EMAIL PASSWORD RESET LINK</button>
        </div>
    </form>
</x-layout>
