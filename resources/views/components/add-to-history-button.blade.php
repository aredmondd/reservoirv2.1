@props(['id', 'name', 'flag', 'released', 'length'])

<div class="relative group text-white text-opacity-50">
        <form method="POST" id="rating-form-dashboard-{{ $id }}" action="/history?id={{$id}}&name={{$name}}&content_type={{$flag}}&released={{$released}}&length={{$length}}"> 
            @csrf
            <x-content-modal-rating :name='$name' :id='$id'/>
        </form>

    <!-- Tooltip -->
    <x-hover-tooltip text="Add to History" />
</div>

