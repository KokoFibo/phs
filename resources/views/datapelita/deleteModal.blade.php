{{-- modal Add --}}
<div wire:ignore.self class="modal fade " id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <p><strong>Yakin, data mau di hapus?</strong></p>


            </div>
            <div class="modal-footer">

                <button class="btn btn-danger" wire:click="delete">Delete</button>
                <button class="btn btn-primary" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>
{{-- Modal Add End --}}
