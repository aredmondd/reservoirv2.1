<?php
use App\Models\User;
use Carbon\Carbon;

$num_requests = count(Auth::user()->pending_friend_requests ?? []);
// $num_recommended = count(Auth::user()->recommended_content ?? []);

?>

<x-layout>

    <h1 class="text-white font-serif text-mega text-center my-12 mb-6">Friends</h1>

    <div class="flex justify-center space-x-12">
        <a href="/my-friends?view=add" class="{{ request()->input('view') == 'add' || request()->input('query') != null || request()->input('view') == null ? 'text-blue text-opacity-100' : 'text-white text-opacity-50' }}">Add Friends</a>
        <a href="/my-friends?view=current-friends" class="{{ request()->input('view') == 'current-friends' ? 'text-blue text-opacity-100' : 'text-white text-opacity-50' }}">My Friends</a>
        <a href="/my-friends?view=requests" class="{{ request()->input('view') == 'requests' ? 'text-blue text-opacity-100' : 'text-white text-opacity-50' }}">Requests {{ $num_requests > 0 ? '(' . $num_requests . ')' : '' }}</a>
        <a href="/my-friends?view=recommended" class="{{ request()->input('view') == 'recommended' ? 'text-blue text-opacity-100' : 'text-white text-opacity-50' }}">Recommended</a>
    </div>

    @if (!request()->input('view') || request()->input('view') == 'add')
        <div class="px-96 mb-24 mt-12">
            <hr class='border-white border-opacity-25 mx-12 mt-6'>
            <form action="/my-friends?view=add" method="GET" class="flex justify-center mt-6">
                <div class="relative text-white">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search for users" class="pl-10 text-body text-white rounded-full w-full py-2 px-40 bg-white bg-opacity-25 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue"/>
                </div>
                <button type="submit" class="px-4 py-2 rounded-full bg-blue ml-4 font-sans focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue">Search</button>
            </form>


            @if(isset($users))
                <hr class='border-white border-opacity-25 mx-12 mt-6'>

                <ul>
                    @forelse($users as $user)
                        <x-search-result :user='$user'></x-search-result>
                    @empty
                        <li class="text-white text-body font-sans text-opacity-50 text-center mt-6">No users found...</li>
                    @endforelse
                </ul>
            @endif
        </div>
    @elseif(request()->input('view') == 'current-friends')
        <div class="mt-12 mx-96">
            <hr class='border-white border-opacity-25 mx-12 my-3'>
            @if(empty($currentFriends))
            <div class="mt-12 text-center text-white text-opacity-50 text-body">so empty... find some <a href="/my-friends?view=add" class="text-aqua underline" >friends</a>?</div>
            @else
            @foreach($currentFriends as $friends)
                <?php $requestedUser = User::find($friends['id']); ?>
            
                @if($requestedUser)
                <div class="flex justify-between items-center mx-20 my-6">
                    <a class="flex" href="/user/{{ $requestedUser->username }}">
                    <img src="{{ $requestedUser->profile_picture != null ? asset('storage/' . $requestedUser->profile_picture) : asset('images/default.png') }}" class="w-16 h-16 rounded-full mr-6">
                    <div class="flex flex-col">
                        <h1 class="text-white text-title font-serif hover:text-blue transition-all ease-in-out duration-500">{{ $requestedUser->name }}</h1>
                        <p class="text-white text-opacity-50 font-sans text-sm">{{ $requestedUser->username }}</p>
                    </div>
                    </a>
                    <div class="flex items-center space-x-2">
                    <form action="{{ route('friend.delete') }}" method="POST" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="requested_user_id" value="{{ $requestedUser->id }}">
                        <button type="submit">
                            <img src="images/delete.png" alt="Delete" class="w-8 hover:opacity-75 transition ease-in-out duration-300">
                        </button>
                    </form>
                    </div>
                </div>
                <hr class='border-white border-opacity-25 mx-12 my-6'>
                @else
                <p>User not found for ID {{ $friends['id'] }}</p>
                @endif
            @endforeach
            @endif
        </div>
    @elseif(request()->input('view') == 'requests')
        <div class="mt-12 mx-96">
            <hr class='border-white border-opacity-25 mx-12 my-3'>
            @if(empty($friendRequests))
            <div class="mt-12 text-center text-white text-opacity-50 text-body">so empty...</div>
            @else
            @foreach($friendRequests as $friends)
                <?php $requestedUser = User::find($friends['id']); ?>
            
                @if($requestedUser)
                <div class="flex justify-between items-center mx-20 my-6">
                    <a class="flex" href="/user/{{ $requestedUser->username }}">
                    <img src="{{ $requestedUser->profile_picture != null ? asset('storage/' . $requestedUser->profile_picture) : asset('images/default.png') }}" class="w-16 h-16 rounded-full mr-6">
                    <div class="flex flex-col">
                        <h1 class="text-white text-title font-serif hover:text-blue transition-all ease-in-out duration-500">{{ $requestedUser->name }}</h1>
                        <p class="text-white text-opacity-50 font-sans text-sm">{{ $requestedUser->username }}</p>
                    </div>
                    </a>
                    <div class="flex items-center space-x-2">
                    <form action="{{ route('friend.accept') }}" method="POST" class="inline-block">
                        @csrf
                        <input type="hidden" name="requested_user_id" value="{{ $requestedUser->id }}">
                        <button class="material-symbols-outlined text-white text-title mr-2 hover:text-blue transition ease-in-out duration-300">check_circle</button>
                    </form>
                    <form action="{{ route('friend.decline') }}" method="POST" class="inline-block ml-2">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="requested_user_id" value="{{ $requestedUser->id }}">
                        <button type="submit">
                            <img src="images/delete.png" alt="Delete" class="w-8 hover:opacity-75 transition ease-in-out duration-300">
                        </button>
                    </form>
                    </div>
                </div>
                <hr class='border-white border-opacity-25 mx-12 my-6'>
                @else
                <p>User not found for ID {{ $friends['id'] }}</p>
                @endif
            @endforeach
            @endif
        </div>
        @elseif(request()->input('view') == 'recommended')
    <div class="mt-12 mx-96">
        <hr class="border-white border-opacity-25 mx-12 my-3">
        @if(Auth::user()->recommended_content && count(Auth::user()->recommended_content) > 0)
            @foreach(Auth::user()->recommended_content as $content)
                <?php
                    $posterPath = $content['posterPath'];
                    $content_type = $content['content_type'];
                    $content_message = $content['message'];
                    $content_id = $content['content_id'];
                    $content_recommender = $content['recommender'];
                    $content_name = $content['content_name'];
                    $addedAt = Carbon::parse($content['time'])->toFormattedDateString();
                ?>
                
                <div class="flex justify-between items-center mx-20 my-6">
                    <div class="flex">
                        <img src="{{ $posterPath ? 'https://image.tmdb.org/t/p/w500' . $posterPath : asset('images/no-movie-poster.jpg') }}" alt="Poster" class="rounded-lg w-32">
                        <div class="flex flex-col justify-between mx-12">
                            <div>
                                <a href="{{ route('content', ['movie' => $content_id, 'flag' => $content_type]) }}" class="font-serif text-title text-white hover:text-blue transition-all ease-in-out duration-500">{{ $content_name }}</a>
                                <div class="flex space-x-2 text-body text-white text-opacity-50">
                                    <p>{{ $content_recommender }}</p>
                                    <p>|</p>
                                    <p>{{ $addedAt }}</p>
                                </div>
                            </div>
                            <p class="text-body text-white text-opacity-50">{{ Str::limit($content_message, 200, '...') }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col items-end space-y-2">
                        <form action="{{ route('friend.decline') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-8 hover:opacity-75 transition ease-in-out duration-300">
                                <img src="{{ asset('images/delete.png') }}" alt="Delete">
                            </button>
                        </form>
                    </div>
                </div>
                <hr class="border-white border-opacity-25 mx-12 my-6">
            @endforeach
        @else
            <div class="mt-12 text-center text-white text-opacity-50 text-body">You have no recommended content...</div>
        @endif
    </div>

    @endif

</x-layout>