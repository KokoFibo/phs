<div>
    <div class="flex justify-center">
        <div class="block max-w-sm p-6 bg-white rounded-lg shadow-lg">
            <h5 class="mb-2 text-xl font-medium leading-tight text-gray-900">{{ $judul }} Kelas Id: {{ $daftarKelasId }}
            </h5>
            <p class="mb-4 text-base text-gray-700">{{ $content }}</p>
            <button wire:click="kirimId($daftarKelasId)" type="button"
                class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Button</button>
        </div>
    </div>
</div>