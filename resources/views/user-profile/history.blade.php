<x-profile-wrapper :user='$user'>
    <div class="mt-24"></div>

    <x-watchlist-header />

    <hr class='border-white border-opacity-25 mx-40 my-3'>

    @if ($history == null)
        <x-empty />
    @else
        @foreach ($history as $content)
            <x-friend-content-row :content='$content'/>
        @endforeach
    @endif

    <div class="mb-24"></div>
</x-profile-wrapper>