<x-profile-wrapper :user='$user'>
    <div class="mt-24"></div>

    <div class="grid grid-cols-6 mx-40">
        <div class="col-span-5 grid grid-cols-6 text-white">
            <p>date added</p>
            <p class="col-span-2">content</p>
            <p>released</p>
            <p>runtime</p>
        </div>
    </div>

    <hr class='border-white border-opacity-25 mx-40 my-3'>

    @if ($watchlist == null)
        <div class="py-32 text-center text-white text-opacity-50 text-body">
            so empty...
        </div>
    @else
        @foreach ($watchlist as $content)
            <x-friend-content-row :content='$content'/>
        @endforeach
    @endif

    <div class="mb-24"></div>
</x-profile-wrapper>