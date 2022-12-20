<div>

    <div class="col-2 mt-3">
        <label>Provinsi</label>
        <select class="form-control" wire:model="selectedProvince">
            <option value="" selected>-- Provinsi --</option>
            @foreach ($province as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    @if (!is_null($selectedProvince))
        <div class="col-2 mt-3">
            <label>Kota</label>
            <select class="form-control" wire:model="selectedRegency">
                <option value="" selected>-- Kota --</option>
                @foreach ($regency as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>


    @endif


</div>
