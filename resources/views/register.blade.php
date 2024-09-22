<x-layout>
    <div class="mt-14">
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
                </form>
            </div>
        </div>
    </div>
</x-layout>