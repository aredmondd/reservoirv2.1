<x-layout>

    @if(session()->has('error'))
        <div class="fixed top-5 inset-x-0 mx-auto w-1/6 px-3 py-2 bg-red-500 text-midnight rounded font-sans text-center animate-slide-in-out">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="text-white font-serif text-mega text-center mt-12">
        My Reservoir
    </h2>

    <div class="mt-24"></div>

    <div class="flex justify-between mx-40 items-center">
        <form action="/dashboard" method="GET" class="text-white">
            <div class="flex space-x-4">
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" id="simple-search" value="{{ request()->input('search') }}" class="pl-10 text-small text-white rounded-full w-full py-2 px-20 bg-white bg-opacity-25 placeholder:pl-2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue"/>
                </div>
                <input type="hidden" name="view" value="{{ request()->input('view') ?? 'watchlist' }}" />
                <button class="py-2 px-6 rounded-full bg-white bg-opacity-75 text-midnight font-semibold text-center tracking-widest">CLEAR</button>
            </div>
        </form>

        <div class="flex items-center pb-2 space-x-4">
            <a href="/dashboard?view=watchlist"><button class="mt-2 inline-flex items-center px-4 py-2 {{ request()->input('view') == 'watchlist' || !request()->input('view') ? 'bg-blue' : 'bg-white bg-opacity-75'}} rounded-md font-semibold text-sm text-midnight uppercase tracking-widest hover:bg-blue focus:outline focus:outline-2 transition ease-in-out duration-150">Watchlist</button></a>
            <a href="/dashboard?view=history"><button class="mt-2 inline-flex items-center px-4 py-2 {{ request()->input('view') == 'history' ? 'bg-blue' : 'bg-white bg-opacity-75'}} rounded-md font-semibold text-sm text-midnight uppercase tracking-widest hover:bg-blue focus:outline focus:outline-2 transition ease-in-out duration-150">History</button></a>
        </div>
    </div>

    <hr class='border-white border-opacity-25 mx-40 my-3'>

    @if (request()->input('view') == 'watchlist' || !request()->input('view'))
    <x-watchlist-header />
    @else
    <x-history-header />
    @endif

    <hr class='border-white border-opacity-25 mx-40 my-3'>

    @if ($list->isEmpty())
        <x-empty />
    @else
        @foreach ($list as $content)
            <x-content-row :content='$content'/>
        @endforeach

        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $list->appends(request()->query())->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <div class="mb-24"></div>

</x-layout>
