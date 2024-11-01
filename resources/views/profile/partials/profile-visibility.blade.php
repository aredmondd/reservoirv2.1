<section>
    <header>
        <h2 class="text-title font-medium text-blue">
            Account visibility
        </h2>

        <p class="mt-1 text-sm text-white text-opacity-50">
            Allow your account to be viewed by other users
        </p>
    </header>

    <form method="post" action="{{ route('profile.update-visibility') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="flex items-center ps-4 border border-white border-opacity-50 rounded-lg">
            <input id="public-profile" type="radio" value="public" name="visibility" class="w-4 h-4 text-blue border-white focus:outline-none focus:ring-blue focus:ring-2"
                {{ auth()->user()->is_private ? '' : 'checked' }}>
            <label for="public-profile" class="w-full py-4 ms-2 text-sm text-white text-opacity-50">Public Profile</label>
        </div>
        <div class="flex items-center ps-4 border border-white border-opacity-50 rounded-lg">
            <input id="private-profile" type="radio" value="private" name="visibility" class="w-4 h-4 text-blue border-white focus:outline-none focus:ring-blue focus:ring-2"
                {{ auth()->user()->is_private ? 'checked' : '' }}>
            <label for="private-profile" class="w-full py-4 ms-2 text-sm text-white text-opacity-50">Private Profile</label>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>
        </div>
    </form>
</section>
