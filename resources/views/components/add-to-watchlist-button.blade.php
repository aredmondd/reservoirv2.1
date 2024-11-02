@props(['id', 'name', 'flag'])

<form action="/watchlist?id={{$id}}&name={{$name}}&content_type={{$flag}}" method="POST">
    @csrf

    <button type="submit" class="text-sm text-white text-opacity-50 hover:text-opacity-100 hover:cursor-pointer transition ease-in-out duration-500"><span class="material-symbols-outlined">collections_bookmark</span></button>
</form>