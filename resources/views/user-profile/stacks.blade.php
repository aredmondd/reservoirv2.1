<x-profile-wrapper :user='$user'>
    <div class="mx-40 flex justify-between mt-12 mb-24">
        @foreach ($stacks as $stack)
            <x-dynamic-stack :stack='$stack'/>
        @endforeach
    </div>
</x-profile-wrapper>