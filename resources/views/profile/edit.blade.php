<x-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-12">
        <h2 class="text-mega text-white font-serif">
            {{ __('Edit Profile') }}
        </h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 border border-white border-opacity-50 bg-opacity-50 rounded-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 border border-white border-opacity-50 rounded-md">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 border border-white border-opacity-50 rounded-md">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-layout>
