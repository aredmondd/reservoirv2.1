<x-profile-wrapper :user='$user'>
    <div class="grid grid-cols-6 mx-40">
        <div class="col-span-5 grid grid-cols-6 text-white">
            <p>date added</p>
            <p class="col-span-2">content</p>
            <p id ='released'>released</p>
            <p id ='length'>length</p>
        </div>
    </div>

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