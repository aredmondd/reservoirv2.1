<x-layout>
    <h2 class="text-white font-serif text-mega text-center mt-12">
        Welcome back, {{ Auth::user()->name }}
    </h2>

    <p>{{ Auth::user()->backlog->id }}</p>

    <div class="mt-12"></div>

    <div class="flex">
    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/default.png') }}" alt="" class="w-32 rounded-full">
    </div>

</x-layout>
