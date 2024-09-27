<button {{ $attributes->merge(['type' => 'submit', 'class' => 'mt-2 inline-flex items-center px-4 py-2 bg-white bg-opacity-75 rounded-md font-semibold text-sm text-midnight uppercase tracking-widest hover:bg-blue focus:outline focus:outline-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
