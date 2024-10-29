@if(session()->has('success'))
    <div class="fixed top-5 inset-x-0 mx-auto w-max px-3 py-2 bg-green-500 text-midnight rounded font-sans text-center animate-slide-in-out">
        {{ session('success') }}
    </div>
@endif