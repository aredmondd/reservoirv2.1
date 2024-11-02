<div class="flex justify-between items-center mx-20 my-6">
    <a class="flex" href="/user/{{ $user->username }}">
        <img src="{{ $user->profile_picture != null ? asset('storage/' . $user->profile_picture) : asset('images/default.png') }}" class="w-16 h-16 rounded-full mr-6">
        <div class="flex flex-col">
            <h1 class="text-white text-title font-serif hover:text-blue transition-all ease-in-out duration-500">{{ $user->name }}</h1>
            <p class="text-white text-opacity-50 font-sans text-sm">{{ $user->username }}</p>
        </div>
    </a>
    <!-- if the current user is already friends with user they are viewing -->

    <!-- if the current user is not already friends with the user they are viewing -->
    <form action="{{ route('friend.add') }}" method="POST">
        @csrf
        <input type="hidden" name="requested_user_id" value="{{ $user->id }}">
        <button class="text-white border border-blue rounded-full px-6 p-2 hover:bg-blue transition ease-in-out duration-300">Add Friend</button>
    </form>

</div>

<hr class='border-white border-opacity-25 mx-12 my-6'>
