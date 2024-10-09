<x-layout>
    <form action="{{ route('search') }}" method="GET" class="flex justify-center">
        <div class="relative text-white">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" name="query" class="pl-10 text-small text-white rounded-full w-full py-2 px-20 bg-white bg-opacity-25 placeholder:pl-2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue"/>
        </div>
        <button type="submit" class="px-3 py-2 rounded-full bg-blue ml-4 font-sans focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">Search</button>
    </form>

    <br>
    <br>

    @if(isset($users))
        <ul>
            @forelse($users as $user)
                <li class="text-white text-sm font-sans text-center"><a href="user/{{$user->username}}">{{ $user->name }} ({{ $user->username }})</a></li>
            @empty
                <li class="text-white text-sm font-sans text-opacity-50 text-center">No users found</li>
            @endforelse
        </ul>
    @endif
</x-layout>
