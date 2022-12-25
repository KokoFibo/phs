<div>
    <label for="branch">Pengajak</label>
    <input type="text" class="form-control" wire:model="query" wire:keydown.escape="reset1" wire:keydown.tab="reset1"
        wire:keydown.ArrowUp="decrementHighlight" wire:keydown.ArrowDown="incrementHighlight"
        wire:keydown.enter="selectContact" />

    @if (!empty($query))
        {{-- <div style="position: fixed; top: 0px; right: 0px; bottom: 0px; left: 0px;" wire:click="reset1"></div> --}}
        <div class="position-absolute  list-group" style="z-index: 10;">
            @if (!empty($contacts))

                @foreach ($contacts as $i => $contact)
                    <a href="{{ route('adddata', $contact['id']) }}"
                        class="text-decoration-none list-group-item  {{ $highLightIndex === $i ? 'active' : '' }}">
                        {{ $contact['nama_umat'] }}</a>
                @endforeach
            @else
                <div class="list-group-item">No result!</div>
            @endif
        </div>
    @endif


</div>
