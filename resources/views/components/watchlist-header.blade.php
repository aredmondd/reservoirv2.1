
<?php

$nextSortOrder = 'normal';
$array = ['normal','asc','des'];
$last = '';

// if link is clicked 


?>

<div class="grid grid-cols-6 mx-40">
    <div class="col-span-5 grid grid-cols-6 text-white">
        <a href = "{{ route('display_list', ['view' => request()->input('view', 'watchlist'), 'filterBy' => 'time']) }}">date added</a>
        <p class="col-span-2">content</p>
        <a id ='released' href = "{{ route('display_list', ['view' => request()->input('view', 'watchlist'), 'filterBy' => 'released']) }}" onclick='sortOrder()'>released</a>
        <a id ='length' href = "{{ route('display_list', ['view' => request()->input('view', 'watchlist'), 'filterBy' => 'length']) }}">length</a>
    </div>
</div>

<script>
    let order = 1;
    function sortOrder(){
        if(order == 1){
            // normal array can lokey sort this by time to set it back to the correct thing
            
        } else if(order == 2){
            // this will be ascending order 

        } else if(oder == 3){
            // this will be descending order

        } else { // equal to 4
            order = 0;
            sortOrder();
        }

    }
</script>