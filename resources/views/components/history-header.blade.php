<div class="grid grid-cols-6 mx-40">
    <div class="col-span-5 grid grid-cols-6 text-white">
        <a href = "{{ route('display_list', ['view' => request()->input('view', 'history'), 'filterBy' => 'time']) }}">date watched</a>
        <p class="col-span-2">content</p>
        <a href = "{{ route('display_list', ['view' => request()->input('view', 'history'), 'filterBy' => 'released']) }}">released</a>
        <a href = "{{ route('display_list', ['view' => request()->input('view', 'history'), 'filterBy' => 'length']) }}">length</a>
        <a href = "{{ route('display_list', ['view' => request()->input('view', 'history'), 'filterBy' => 'rating']) }}">rating</a>
    </div>
</div>