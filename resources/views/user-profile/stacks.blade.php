<x-profile-wrapper :user='$user'>
    @if ($stacks != null)
    <div class="mx-40 flex justify-between mt-12 mb-24">
        @foreach ($stacks as $stack) 
            @if(!$stack['isPrivate'])
                <x-content-stack-friend-view :stack='$stack'/>
            @endif
        @endforeach
    </div>
    @else
    <x-empty />
    @endif
</x-profile-wrapper>