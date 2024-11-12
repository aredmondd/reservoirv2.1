<x-profile-wrapper :user='$user'>
    <x-watchlist-header />

    <hr class='border-white border-opacity-25 mx-40 my-3'>

    @if ($currently_watching == null)
        <x-empty />
    @else
        @foreach ($currently_watching as $content)
            <x-friend-content-row :content='$content'/>
        @endforeach
    @endif

    <div class="mb-24"></div>
</x-profile-wrapper>