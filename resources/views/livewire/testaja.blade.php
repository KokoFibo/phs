<div>
      <div class="flex justify-evenly ">
            <div>
                  <label for="">Pilih Group: </label>
                  <select wire:model="selectedGroup">
                        <option value="">Pilih Group</option>

                        @foreach ($groupvihara as $g)
                        <option value="{{ $g->id }}">{{ $g->nama_group }}</option>
                        @endforeach
                  </select>

            </div>
            <div>

                  <label for="">Pilih Branch: </label>
                  <select wire:model="selectedBranch">
                        <option value="">Pilih Branch</option>
                        @foreach ($branch as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
                        @endforeach
                  </select>
            </div>
      </div>
      <div class="w-3/4 mx-auto mt-20">
            <p>selectedGroup: {{ $selectedGroup }}</p>
            <p>selectedBranch: {{ $selectedBranch }}</p>

            <h1>ToTal Data Umat selected group : {{ $totalpergroup }} </h1>
            <h1>ToTal Data Umat umatYTDpergroup selected group : {{ $umatYTDpergroup }} </h1>


      </div>
</div>
