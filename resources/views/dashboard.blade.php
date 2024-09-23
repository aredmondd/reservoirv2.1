<x-layout>
    <h2 class="text-white font-sans text-mega text-center">
        Welcome back, {{ Auth::user()->name }}
    </h2>

    <div class="mt-12"></div>

    <h1 class="text-white text-mega font-serif text-center">Recently watched</h1>
    <div class="mt-12"></div>
    <div class="flex mx-8 justify-between text-white">
        <div class="border border-white border-opacity-50 p-20 py-32 rounded-md mx-2">movie</div>
        <div class="border border-white border-opacity-50 p-20 py-32 rounded-md mx-2">movie</div>
        <div class="border border-white border-opacity-50 p-20 py-32 rounded-md mx-2">movie</div>
        <div class="border border-white border-opacity-50 p-20 py-32 rounded-md mx-2">movie</div>
        <div class="border border-white border-opacity-50 p-20 py-32 rounded-md mx-2">movie</div>
        <div class="border border-white border-opacity-50 p-20 py-32 rounded-md mx-2">movie</div>
    </div>


</x-layout>
