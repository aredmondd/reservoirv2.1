@props(['id', 'name', 'flag', 'released', 'length'])

<div class="relative group">
    <form action="/currently-watching?id={{$id}}&name={{$name}}&content_type={{$flag}}&released={{$released}}&length={{$length}}" method="POST" >
        @csrf

        <button type="submit" class="text-white text-opacity-50 text-sm hover:text-opacity-100 hover:cursor-pointer transition ease-in-out duration-500"><span class="material-symbols-outlined">visibility</span></button>
    </form>

    <x-hover-tooltip text='Add to Currently Watching' />
</div>