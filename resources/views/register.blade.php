<x-layout>
    <div class="mt-28">
        <h1 class="text-center font-serif text-mega text-blue mb-10">Ready to dive in?</h1>
        <div class="flex flex-col justify-center">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="/register" method="POST">
                    @csrf
                    <x-input-form name="name" type="text" placeholder="Name" value="{{old('name')}}" autocomplete="" required></x-input-form>
                    @error('name')
                        <!--  dont want ugly code but error goes here -->
                        <p> {{$message}} </p>
                    @enderror
                    <x-input-form name="name" type="text" placeholder="Username" autocomplete="" required></x-input-form>
                    @error('name')
                        <!--  dont want ugly code but error goes here -->
                        <p> {{$message}} </p>
                    @enderror
                    <x-input-form name="name" type="email" placeholder="Email" autocomplete="Email" required></x-input-form>
                    @error('name')
                        <!--  dont want ugly code but error goes here -->
                        <p> {{$message}} </p>
                    @enderror
                    <x-input-form name="name" type="password" placeholder="Password" autocomplete="Password" required></x-input-form>
                    @error('name')
                        <!--  dont want ugly code but error goes here -->
                        <p> {{$message}} </p>
                    @enderror

                    <button type="submit" class="flex w-full justify-center rounded-full bg-blue p-1.5 text-sm font-semibold leading-6 text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">Register</button>
                </form>
                <p class="mt-4 text-center text-small text-white text-opacity-75">
                Already have an account?
                <a href="/signin" class="font-semibold leading-6 text-aqua focus:outline-none focus:underline hover:underline focus:hover:underline-offset-2">Sign in here</a>
                </p>
            </div>
        </div>
    </div>
</x-layout>