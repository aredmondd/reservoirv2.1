@props(['stars'])

<p>
<?php
for ($i = 1; $i <= 5; $i++) {
    if ($stars >= $i) {
        echo '<span class="material-symbols-outlined text-yellow-500">star</span>';
    } else {
        echo '<span class="material-symbols-outlined text-white text-opacity-50">star</span>';
    }
}
?>
</p>