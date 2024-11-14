@props(['id', 'name', 'flag', 'released', 'length'])

<div class="relative group">
    <x-content-modal-rating :name='$name' :id='$id'/>

    <!-- Tooltip -->
    <x-hover-tooltip text="Add to History" />
</div>

