@props(['id'])

<form action="{{ route('add-movie-stack') }}" method="POST">
    @csrf

    <input type="hidden" name="content_id" value="{{ $id }}">

    <button type="submit" class="border border-blue rounded-full text-sm text-blue p-2 px-3 hover:cursor-pointer">Add to Stack</button>
</form>