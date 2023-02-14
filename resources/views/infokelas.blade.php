{{-- <p>selected branch = {{ getBranch($selectedBranch) }}</p> --}}
<div>
    {{-- <x-card smalltext="Umat" bigtext="{{ $totalUmat_sp }}" textcolor="text-purple-500"
        bordercolor="border-purple-500" /> --}}
    {{-- @dump($selectedDaftarKelas_id) --}}
    <h1 class="text-7xl text-black text-center font-semibold my-5">{{ getBranch($selectedBranch) }}</h1>
    @foreach ($selectedDaftarKelas_id as $item)
        {{-- <p>Nama Kelas : {{ getNamaKelas($item) }} </p> --}}
        <x-absensicard judul="{{ getNamaKelas($item) }}"
            content="Some quick example text to build on the card title and make up the bulk of the card's
        content." />
    @endforeach

</div>
