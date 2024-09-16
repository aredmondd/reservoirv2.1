<x-layout>
    <div class="mt-14">
        <h1 class="text-center font-serif text-mega text-blue mb-10">Back to the flow</h1>
        <div class="flex flex-col justify-center">
            <div class="mt-auto sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="#" method="POST">
                
                    <x-input-form name="email" type="text" placeholder="Email" autocomplete="Email"></x-input-form>
                    <x-input-form name="password" type="password" placeholder="Password" autocomplete="autocomplete-password"></x-input-form>

                    <div class="text-center mt-15">
                        <button class="text-midnight rounded-full bg-blue p-3 px-10 font-sans text-body bg-gradient-to-tl to-blue from-aqua from-10% bg-size-200 bg-pos-0 hover:bg-pos-100 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue transition-[background-position] duration-500">Sign In</button>
                    </div>
                </form>
                <p class="mt-4 text-center text-small text-white text-opacity-50">
                Don't have an account?
                <a href="/register" class="font-semibold leading-6 text-aqua focus:outline-none focus:underline hover:underline focus:hover:underline-offset-2">Register here</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>
