<div>
    @include('datapelita.addPanditaModal')
    @include('datapelita.editPanditaModal')

    <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#AddPanditaModal">
        {{-- <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#AddPanditaModal"
        wire:click="clearSession"> --}}
        {{ __('Add Data Pandita') }}
    </button>
</div>
