@props(['id', 'flag', 'name', 'posterPath'])

<div class="relative group">
    <form action="/profile/addToFavorite?id={{$id}}&name={{$name}}&posterPath={{$posterPath}}&flag={{$flag}}" method="POST">
        @csrf

        <button type="submit" class="text-sm text-white text-opacity-50 hover:text-opacity-100 hover:text-blue hover:cursor-pointer transition ease-in-out duration-300"><span class="material-symbols-outlined">heart_plus</span></button>
    </form>

    <x-hover-tooltip text='Display on Profile as Favorite' />
</div>