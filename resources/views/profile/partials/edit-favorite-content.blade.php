<?php
$user = Auth::user();
$content = $user->profile_content_favorites;
?>
<section>
    <h2 class="text-title font-medium text-blue">
        Edit Favorite Content
    </h2>

    @if ($content != null)
        @foreach($content as $content)
        <div class="flex justify-between items-center mx-20 mb-6">
            <div class="flex flex-col">
                <h1 class="text-white text-title font-serif transition-all ease-in-out duration-500">{{ $content['name'] }}</h1>
            </div>
            <div class="flex items-center space-x-2">
            <form action="{{ route('profile.deleteFav') }}" method="POST" class="inline-block ml-2">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{ $content['id'] }}">
                <input type="hidden" name="name" value="{{ $content['name'] }}">
                <button type="submit">
                    <img src="images/delete.png" alt="Delete" class="w-8 hover:opacity-75 transition ease-in-out duration-300">
                </button>
            </form>
            </div>
        </div>
        @endforeach
    @else
        <div class="mt-3 text-white text-opacity-50 text-body">so empty...</div>
    @endif

</section>