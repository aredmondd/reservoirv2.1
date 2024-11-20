


@props(['id'])

<?php

use App\Models\Stack;
use App\Models\User;

$user = Auth::user();
$current_friends = $user->current_friends;
// dump($current_friends, User::where('id', $user->current_friends[0]['id'])->get());
$userStacks = Stack::where('user_id', $user->id)->get();

?>


<div class="relative group">
    <button class="text-sm text-white text-opacity-50 hover:text-blue hover:text-opacity-100 hover:cursor-pointer transition ease-in-out duration-300" x-data="" x-on:click.prevent="$dispatch('open-modal', 'send-friend-modal-{{ $id }}')"><span class="material-symbols-outlined"> send </span></button>

    <x-hover-tooltip text='Recommend to friend' />
</div>

<x-modal name="send-friend-modal-{{ $id }}" :show="$errors->isNotEmpty()" focusable>

    <div x-data="{ selectedFriendId: null}" class="bg-midnight p-8">
        <form :action="`/recommendToFriend?recommended_user_id=${selectedFriendId}&content_id={{$id}}`" 
              method="POST">
            @csrf

            <h2 class="text-title font-serif text-white text-center mb-4">
                Select a Friend to Send it Too:
            </h2>

            <!-- Displaying User Stacks -->
            <div class="text-white mb-6">
                @foreach($current_friends as $friend)
                <?php
                $otherFriend =  User::find($friend['id']);
                ?>
                    <div class="py-2 cursor-pointer" 
                         @click="selectedFriendId = '{{ $friend['id'] }}'">
                         
                        {{ $otherFriend->name }} - {{ $otherFriend->username }}
                    </div>
                @endforeach
            </div>
                <!-- Message Input -->
            <div class="text-white mb-6">
                <label for="message" class="block text-sm mb-2">Add a Message:</label>
                <textarea 
                    id="message" 
                    name="message" 
                    rows="4" 
                    class="w-full p-2 bg-gray-800 text-white border border-gray-600 rounded-lg" 
                    placeholder="Hey yk this shit is peak.">
                  </textarea>
            </div>
            <div class="mt-6 flex justify-between items-center">
            <button type="button" 
                        x-on:click="$dispatch('close-modal', 'send-friend-modal-{{ $id }}')" 
                        class="text-midnight bg-white rounded-full px-4 p-2 font-medium tracking-wide "> 
                    Cancel
                </button>
                <button type="submit" 
                        class="text-white bg-blue rounded-full px-4 p-2 font-medium tracking-wide" 
                        :disabled="!selectedFriendId">
                    Send
                </button>
            </div>
        </form>
    </div>
</x-modal>