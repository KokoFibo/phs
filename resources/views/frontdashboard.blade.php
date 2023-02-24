{{-- <label>Pilih Cetya</label> --}}
{{-- <select wire:model="selectedBranch">
    <option value="">Pilih Cetya</option>
    @foreach ($branch as $b)
    <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
@endforeach
</select> --}}
{{-- select box --}}
<div class="flex items-center w-full pt-5 px-14">

      <div class="relative inline-flex w-1/4 m-5">

            @if (Auth::user()->role == 3)

            {{-- <span>Pilih Cetya</span> --}}
            <select wire:model="selectedGroup" class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none">
                  <label>Pilih Kelas</label>
                  <option value="">Pilih Cetya</option>
                  @foreach ($groupvihara as $g)
                  <option value="{{ $g->id }}">{{ $g->nama_group }}</option>
                  @endforeach
            </select>
            @endif

      </div>

      <div class="relative inline-flex w-1/4 m-5">



            {{-- <span>Pilih Cetya</span> --}}
            <select wire:model="selectedBranch" class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none">
                  <label>Pilih Kelas</label>
                  <option value="">Pilih Cetya</option>
                  @foreach ($branch as $b)
                  <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
                  @endforeach
            </select>

      </div>
      <div class="w-full">

            <p>Selected Group : {{ $selectedGroup }}</p>
            <p>Selected Branch : {{ $selectedBranch }}</p>
      </div>
      <div class=w-full mx-auto>
            {{-- <h1 class="text-4xl font-semibold text-center text-purple-500">{{ getBranch($selectedBranch) }}</h1> --}}
      </div>
</div>
{{-- select box end --}}
<div class="flex flex-col items-center pt-5 bg-purple-100 md:flex md:flex-row md:justify-evenly md:pt-10 ">

      <div>
            <x-card smalltext="Umat" bigtext="{{ $totalUmat }}" textcolor="text-purple-500" bordercolor="border-purple-500" />
      </div>
      <div>
            <x-card smalltext="Umat Active" bigtext="{{ $umatActive }}" textcolor="text-green-500" bordercolor="border-green-500" />
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
<div class="flex flex-col items-center gap-2 bg-purple-100 md:flex md:flex-row md:justify-evenly md:pt-10">
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
{{-- <div class="flex flex-col items-center gap-2 bg-purple-100 md:flex md:flex-row md:justify-evenly md:pt-10">
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
