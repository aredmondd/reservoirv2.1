<x-layout>
    <div class="bg-hero bg-no-repeat bg-cover bg-center bg-fixed"></div>
    <div class="mt-40">
        <h1 class="text-center font-serif text-mega text-blue">Back to the Flow 🌊</h1>
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="mt-auto sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="#" method="POST">
                
                    <x-input-form name="email" type="text" placeholder="Email" autocomplete="Email"></x-input-form>
                    <x-input-form name="password" type="password" placeholder="Password" autocomplete="autocomplete-password"></x-input-form>

                    <button type="submit" class="flex w-full justify-center rounded-full bg-blue p-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue hover:focus-visible:outline-light-blue">Sign in</button>
                </form>
                <p class="mt-4 text-center text-small text-white text-opacity-50">
                Don't have an account?
                <a href="/register" class="font-semibold leading-6 text-aqua focus:outline-none focus:underline hover:underline focus:hover:underline-offset-2">Register here</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>
