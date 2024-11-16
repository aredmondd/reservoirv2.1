@props(['sortOrder'])

<?php

if (request()->input('sortOrder') == null || request()->input('sortOrder') == 'asc' ) {
    $icon = '';
} elseif (request()->input('sortOrder') == 'normal') {
    $icon = '<span class="material-symbols-outlined text-blue">keyboard_arrow_up</span>';
} elseif(request()->input('sortOrder') == 'desc') {
    $icon = '<span class="material-symbols-outlined text-blue">keyboard_arrow_down</span>';
}

?>

<div class="grid grid-cols-6 mx-40">
    <div class="col-span-5 grid grid-cols-6 text-white">
        <div class="flex">
            <a href = "{{ route('display_list', ['view' => request()->input('view', 'watchlist'), 'filterBy' => 'time', 'sortOrder' => $sortOrder]) }}">date added</a>
            @if(request()->input('filterBy') == 'time')
                {!! $icon !!}
            @endif
        </div>
        <div class="flex col-span-2">
            <a href = "{{ route('display_list', ['view' => request()->input('view', 'watchlist'), 'filterBy' => 'name', 'sortOrder' => $sortOrder]) }}">content</a>
            @if(request()->input('filterBy') == 'name')
                {!! $icon !!}
            @endif
        </div>
        <div class="flex">
            <a id ='released' href = "{{ route('display_list', ['view' => request()->input('view', 'watchlist'), 'filterBy' => 'released', 'sortOrder' => $sortOrder]) }}">released</a>
            @if(request()->input('filterBy') == 'released')
                {!! $icon !!}
            @endif
        </div>
        <div class="flex">
            <a id ='length' href = "{{ route('display_list', ['view' => request()->input('view', 'watchlist'), 'filterBy' => 'length', 'sortOrder' => $sortOrder]) }}">length</a>
            @if(request()->input('filterBy') == 'length')
                {!! $icon !!}
            @endif
        </div>
    </div>
</div>
