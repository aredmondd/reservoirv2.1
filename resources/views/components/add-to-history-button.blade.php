@props(['id', 'flag'])

<form action="/history?id={{$id}}&flag={{$flag}}" method="POST">
    @csrf

    <button type="submit" class="border border-aqua rounded-full text-sm text-aqua p-2 px-3 hover:cursor-pointer">Add to History</button>
</form>