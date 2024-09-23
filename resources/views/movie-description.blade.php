<x-layout>
    <div class="mt-14"></div>
    <div class="mx-24 flex">
        <div class="border border-white border-opacity-25 rounded-md py-60 px-40">Movie Image</div>
        <div class="pl-12"></div>
        <div>
            <div class="flex flex-row justify-between">
                <div>
                    <h1 class="text-mega text-white font-serif">Movie Title</h1>
                    <h3 class="text-body text-white text-opacity-50 font-sans">Movie Release Date | Rating | Time</h3>
                </div>
                <div class="flex">
                    <div class="border border-white border-opacity-25 text-white p-12 rounded-md">star ratings</div>
                    <div class="mr-6"></div>
                    <div class="border border-white border-opacity-25 text-white p-12 rounded-md"># of watchlists</div>
                </div>
            </div>
            <div class="mt-6"></div>
            <p class="text-white text-sm text-opacity-50">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus nulla vel accusamus quam magnam dolorem dolore nemo, dignissimos soluta expedita harum, aperiam laudantium pariatur unde blanditiis labore architecto ipsam natus, minus modi atque! Minus non ducimus quas veniam optio magni soluta perspiciatis ipsum voluptas. Harum amet consequatur voluptatum illo est! Corporis saepe nobis itaque, aperiam nulla blanditiis architecto quaerat aliquam obcaecati, quo quasi reiciendis inventore natus vitae, dicta modi veritatis. Non nam minus distinctio, ipsa fugiat, consequatur rerum quos optio fuga excepturi assumenda voluptatem natus provident eos cum. Ipsum facere debitis laboriosam, quaerat delectus molestiae qui cumque cum mollitia quo.</p>
            <div class="flex flex-row mt-6">
                <x-genre-tag title="Sci-Fi"></x-genre-tag>
                <x-genre-tag title="Horror"></x-genre-tag>
                <x-genre-tag title="Thriller"></x-genre-tag>
                <x-genre-tag title="Drama"></x-genre-tag>
            </div>
            <div class="flex flex-row mt-6"></div>
        </div>
    </div>
</x-layout>