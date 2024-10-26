@props(['id', 'flag'])

<form action='/addToStack?id={{$id}}&content_type={{$flag}}' method="POST">
    @csrf

    <button type="submit" 
            class="text-sm text-white text-opacity-50 hover:text-aqua hover:text-opacity-100 hover:cursor-pointer transition ease-in-out duration-500"
            onclick="showMessage()" ><span class="material-symbols-outlined">layers</span></button>
</form>