<div>

    <div class="card col-4 mt-3 mx-auto">
        <div class="card-header border rounded text-center">
            Reset Password
        </div>
        <div class="card-body">
            <div class=" mt-1 mx-auto  p-3 shadow-lg rounded-5" style="border-radius: 15px">
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input wire:model="password" type="text"
                        class="form-control @error('password')
          is-invalid
        @enderror" id="password"
                        placeholder="New Password" name="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirmed New Password</label>
                    <input wire:model="password_confirmation" type="text"
                        class="form-control @error('password_confirmation')
                    is-invalid
                  @enderror "
                        placeholder="Confirm  New Password">
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <div class="mb-3 ">
                            <button class="btn btn-primary" wire:click="store">Reset</button>
                        </div>

                    </div>
                    <div class="mb-3 ">
                        <button wire:click="cancel" class="btn btn-warning">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}

</div>
