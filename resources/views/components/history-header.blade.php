@props(['sortOrder'])

<div class="grid grid-cols-6 mx-40">
    <div class="col-span-5 grid grid-cols-6 text-white">
        <a href = "{{ route('display_list', ['view' => request()->input('view', 'history'), 'filterBy' => 'time', 'sortOrder' => $sortOrder]) }}">date added</a>
        <a class="col-span-2" href = "{{ route('display_list', ['view' => request()->input('view', 'history'), 'filterBy' => 'name', 'sortOrder' => $sortOrder]) }}">content</a>
        <a id ='released' href = "{{ route('display_list', ['view' => request()->input('view', 'history'), 'filterBy' => 'released', 'sortOrder' => $sortOrder]) }}">released</a>
        <a id ='length' href = "{{ route('display_list', ['view' => request()->input('view', 'history'), 'filterBy' => 'length', 'sortOrder' => $sortOrder]) }}">length</a>
        <a href = "{{ route('display_list', ['view' => request()->input('view', 'history'), 'filterBy' => 'rating', 'sortOrder' => $sortOrder]) }}">rating</a>
    </div>
</div>