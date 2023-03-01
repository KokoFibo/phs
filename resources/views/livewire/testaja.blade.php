<div>
      <div>
            <label>pilih group :</label>
            <select wire:model="selectedGroup">
                  <option value="">Pilih group</option>
                  @foreach ($group as $g)
                  <option value="{{ $g->id }}">{{ $g->nama_group }}</option>
                  @endforeach
            </select>
      </div>

      <div>
            <label>pilih Vihara :</label>
            <select wire:model="selectedBranch">
                  <option value="">Pilih Vihara</option>
                  @foreach ($vihara as $v)
                  <option value="{{ $v->id }}">{{ $v->nama_branch }}</option>
                  @endforeach
            </select>
      </div>
      <p>Seleceted Group : {{ $selectedGroup }}</p>
      <p>Seleceted Branch : {{ $selectedBranch }}</p>
      <p>Data Umat Aktif di {{ $selectedGroup }} {{ $selectedBranch }} = {{ $dataUmatAktif }} Orang.</p>
      <p>Data Umat Tidak Aktif di {{ $selectedGroup }} {{ $selectedBranch }} = {{ $dataUmatTidakAktif }} Orang.</p>
      <p>Total Data Umat di {{ $selectedGroup }} {{ $selectedBranch }} = {{ $totalUmat }} Orang.</p>
      <p>Umat YTD {{ $selectedGroup }} {{ $selectedBranch }} = {{ $umatYTD }} Orang.</p>
</div>
