@props(['text'])

<span class="@if(Route::currentRouteName() == 'index') 
              absolute top-full left-1/2 -translate-x-1/2 mt-2 
            @else 
              absolute top-1/2 left-full ml-2 -translate-y-1/2 
            @endif
            whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 
            px-2 py-1 bg-white bg-opacity-25 text-white text-xs rounded shadow-lg"
      style="transition-delay: 0.3s">

      {{ $text }}
</span>
