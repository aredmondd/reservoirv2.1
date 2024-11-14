<x-layout>
    <h1 class="text-white text-center font-serif text-mega my-12">Journal</h1>

    <hr class='border-white border-opacity-25 mx-40 my-3'>

    <div class="grid grid-cols-7 text-white mx-40">
        <p>note</p>
        <p>date</p>
        <p class="col-span-2">content</p>
        <p>released</p>
        <p>length</p>
        <p>rating</p>
    </div>

    @foreach ($entries as $entry)
        <x-journal-section :content='$entry' />
    @endforeach

    @if (!$entries)
        <x-empty />
    @endif

    <div class="mb-24"></div>
</x-layout>