{{-- <label>Pilih Cetya</label> --}}
{{-- <select wire:model="selectedBranch">
    <option value="">Pilih Cetya</option>
    @foreach ($branch as $b)
    <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
@endforeach
</select> --}}
{{-- select box --}}
<div class="relative inline-flex m-5">
      <svg class="absolute top-0 right-0 w-2 h-2 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
            <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero" />
      </svg>
      {{-- <span>Pilih Cetya</span> --}}
      <select wire:model="selectedBranch" class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none">
            <label>Pilih Kelas</label>
            <option value="">Pilih Cetya</option>
            @foreach ($branch as $b)
            <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
            @endforeach
      </select>

</div>
{{-- select box end --}}
<div class="flex flex-col items-center gap-2 pt-5 mb-2 md:flex md:flex-row md:justify-evenly md:pt-10 ">

      <div>
            <x-card smalltext="Umat" bigtext="{{ $totalUmat }}" textcolor="text-purple-500" bordercolor="border-purple-500" />
      </div>
      <div>
            <x-card smalltext="UmatActive" bigtext="{{ $umatActive }}" textcolor="text-green-500" bordercolor="border-green-500" />
      </div>

      <div>
            <x-card smalltext="Umat Inactive" bigtext="{{ $umatInactive }}" textcolor="text-blue-500" bordercolor="border-blue-500" />
      </div>

      <div>
            <x-card smalltext="Umat {{ getYear() }}" bigtext="{{ $umatYTD }}" textcolor="text-yellow-500" bordercolor="border-yellow-500" />
      </div>
      <div>
            <x-card smalltext="Cetya" bigtext="{{ $totalBranch }}" textcolor="text-red-500" bordercolor="border-red-500" />
      </div>

</div>
{{-- second row --}}
<div class="flex flex-col items-center gap-2 mb-2 md:flex md:flex-row md:justify-evenly md:pt-10 ">
      <div>
            <x-card smalltext="Kelas 3 Hari" bigtext="{{ $sd3h }}" textcolor="text-indigo-500" bordercolor="border-indigo-500" />
      </div>

      <div>
            <x-card smalltext="V. Total" bigtext="{{ $vtotal }}" textcolor="text-orange-500" bordercolor="border-orange-500" />
      </div>
      <div>
            <x-card smalltext="Users" bigtext="{{ $totalUsers }}" textcolor="text-teal-500" bordercolor="border-teal-500" />
      </div>

      <div>
            <x-card smalltext="Future Reserved" bigtext="{{ $umatInactive }}" textcolor="text-pink-500" bordercolor="border-pink-500" />
      </div>

      <div>
            <x-card smalltext="Future Reserved" bigtext="{{ $umatYTD }}" textcolor="text-sky-500" bordercolor="border-sky-500" />
      </div>


</div>
{{-- Third row --}}
{{-- <div class="flex flex-col items-center gap-2 mb-2 md:flex md:flex-row md:justify-evenly md:pt-10 ">
    <div>
        <x-card smalltext="Future Reserved" bigtext="{{ $totalBranch }}" textcolor="text-lime-500"
bordercolor="border-lime-500" />
</div>
<div>
      <x-card smalltext="Future Reserved" bigtext="{{ $totalPandita }}" textcolor="text-fuchsia-500" bordercolor="border-fuchsia-500" />
</div>
<div>
      <x-card smalltext="Future Reserved" bigtext="{{ $totalBranch }}" textcolor="text-red-500" bordercolor="border-red-500" />
</div>
<div>
      <x-card smalltext="Future Reserved" bigtext="{{ $totalPandita }}" textcolor="text-blue-500" bordercolor="border-blue-500" />
</div>
<div>
      <x-card smalltext="Umat {{ getYear() }}" bigtext="{{ $umatYTD }}" textcolor="text-yellow-500" bordercolor="border-yellow-500" />
</div>
</div> --}}
