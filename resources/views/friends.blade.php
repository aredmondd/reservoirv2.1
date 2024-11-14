<?php
use App\Models\User;
?>

<x-layout>

    <div class="grid grid-cols-2">
        <div>
            <h1 class="text-white text-center font-serif text-title mt-12">Friend Requests</h1>
            <hr class='border-white border-opacity-25 mx-12 my-3'>
            @if(empty($friendRequests))
            <div class="mt-12 text-center text-white text-opacity-50 text-body">so empty... find some <a href="/user-search" class="text-aqua underline" >friends</a>?</div>
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

        <div>
            <h1 class="text-white text-center font-serif text-title mt-12">Your Friends</h1>
            <hr class='border-white border-opacity-25 mx-12 my-3'>
            @if(empty($currentFriends))
            <div class="mt-12 text-center text-white text-opacity-50 text-body">so empty... find some <a href="/user-search" class="text-aqua underline" >friends</a>?</div>
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
    </div>



</x-layout>
