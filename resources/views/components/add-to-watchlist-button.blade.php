@props(['id', 'flag'])

<form action="/watchlist?id={{$id}}&content_type={{$flag}}" method="POST">
    @csrf

    <button type="submit" class="border border-blue rounded-full text-sm text-blue p-2 px-3 hover:cursor-pointer">Add to Watchlist</button>
</form>