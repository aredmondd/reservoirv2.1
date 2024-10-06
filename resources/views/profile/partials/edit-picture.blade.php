<div>
    <h2 class="text-title font-medium text-blue">
            {{ __('Edit Profile Picture') }}
        </h2>

    @if(session('success'))
        <div class="text-white text-opacity-50">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.picture.update') }}" method="POST" enctype="multipart/form-data" class="mt-6">
        @csrf
        <input type="file" name="profile_picture" class="text-sm text-white text-opacity-50 file:text-midnight file:uppercase file:font-semibold file:tracking-widest file:mr-5 file:py-2 file:px-3 file:rounded-lg file:border-none file:text-sm file:bg-aqua file:bg-opacity-75 hover:file:cursor-pointer hover:file:bg-blue focus:outline focus:outline-2 transition ease-in-out duration-1000"/>
        
        @error('profile_picture')
            <span class="text-red-600" role="alert">{{ $message }}</span>
        @enderror

        <div class="mt-12"></div>

        <x-primary-button>Update Profile Picture</x-primary-button>
    </form>

</div>
