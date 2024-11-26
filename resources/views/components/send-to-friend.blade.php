@props(['id', 'posterPath', 'content_type', 'name'])

<?php

use App\Models\Stack;
use App\Models\User;

$user = Auth::user();
$current_friends = $user->current_friends;
$userStacks = Stack::where('user_id', $user->id)->get();

?>


<div class="relative group">
    <button 
        class="text-sm text-white text-opacity-50 hover:text-blue hover:text-opacity-100 hover:cursor-pointer transition ease-in-out duration-300" 
        x-data=""
        x-on:click.prevent=" 
            @if($current_friends == null)
                window.location.href = '{{ route('recommend.content') }}' + '?error=no-friends'; 
            @else
                $dispatch('open-modal', 'send-friend-modal-{{ $id }}');
            @endif
        "
    >
        <span class="material-symbols-outlined"> send </span>
    </button>

    <x-hover-tooltip text='Recommend to friend' />
</div>


<x-modal name="send-friend-modal-{{ $id }}" :show="$errors->isNotEmpty()" focusable>

    <div x-data="{ selectedFriendId: null}" class="bg-midnight p-8">
        <form :action="`/recommendToFriend?recommended_user_id=${selectedFriendId}&content_id={{$id}}&posterPath={{$posterPath}}&content_type={{$content_type}}&content_name={{$name}}`" 
              method="POST">
            @csrf

            <h2 class="text-title font-serif text-white text-center mb-4">
                Reccomend to a friend:
            </h2>

            <!-- Displaying Users -->
            <div class="text-white mb-6 mx-24 flex flex-col space-y-2 max-h-60 overflow-y-scroll">
                @foreach($current_friends as $friend)
                <?php
                $otherFriend = User::find($friend['id']);
                ?>
                    <div class="flex">
                        <img src="{{ $otherFriend->profile_picture != null ? asset('storage/' . $otherFriend->profile_picture) : asset('images/default.png') }}" class="w-12 h-12 rounded-full mr-6" alt="">
                        <div>
                            <div
                                class="cursor-pointer text-body"
                                :class="selectedFriendId === '{{ $friend['id'] }}' ? 'text-blue' : ''"
                                @click="selectedFriendId = '{{ $friend['id'] }}'">
                                {{ $otherFriend->name }}
                            </div>
                            <p class="text-sm text-white text-opacity-50">{{ '@' . $otherFriend->username }}</p>
                        </div>
                    </div>
                    <hr class='border-white border-opacity-25 my-6'>
                @endforeach
            </div>



            <div class="relative text-white mb-6" x-data="{ message: '', maxChars: 115 }">
                <!-- Textarea -->
                <textarea 
                    id="message" 
                    name="message"

                    rows="4" 
                    class="w-full p-2 bg-white bg-opacity-10 text-white border border-white border-opacity-25 rounded-lg resize-none"
                    x-model="message"
                ></textarea>
                
                <!-- Character Counter -->
                <div 
                    class="absolute bottom-2 right-2 text-sm" 
                    :class="(maxChars - message.length) < 0 ? 'text-red-500' : 'text-white text-opacity-50'"
                >
                    <span x-text="maxChars - message.length"></span>
                </div>
            </div>


            <div class="mt-6 flex justify-between items-center">
            <button type="button" 
                        x-on:click="$dispatch('close-modal', 'send-friend-modal-{{ $id }}')" 
                        class="text-midnight bg-white rounded-full px-4 p-2 font-medium tracking-wide "> 
                    Cancel
                </button>
                <button type="submit" class="text-white bg-blue rounded-full pl-5 px-4 p-2 font-medium tracking-wide material-symbols-outlined disabled:opacity-50" :disabled="!selectedFriendId">send</button>
            </div>
        </form>
    </div>
</x-modal>