@if (!Auth::check())
    <x-layout>
        <x-about></x-about>
    </x-layout>
@else
    <x-layout>
        <x-about></x-about>
    </x-layout>
@endif