@props(['id', 'name', 'flag'])

<form action="/history?id={{$id}}&name={{$name}}&content_type={{$flag}}" method="POST">
    @csrf

    <button type="submit" class="text-white text-opacity-50 text-sm hover:text-blue hover:text-opacity-100 hover:cursor-pointer transition ease-in-out duration-500"><span class="material-symbols-outlined">history</span></button>
</form>