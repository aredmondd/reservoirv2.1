@props(['stars'])


<p>
<?php
for ($i = 1; $i <= 5; $i++) {
    if ($stars >= $i) {
        echo '<span class="material-symbols-outlined"><img src="images/star_filled.png" alt="" class="w-6"></span>';
    } else {
        echo '<span class="material-symbols-outlined">star</span>';
    }
}
?>
</p>
