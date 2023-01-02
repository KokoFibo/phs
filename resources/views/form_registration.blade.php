{{-- <div class="container"> --}}
<div class="mt-1 mx-auto  p-3 shadow-lg rounded-5" style="border-radius: 15px">
    {{-- <h5 class="mb-3">Registration : {{ $is_edit }}</h5>
    <hr> --}}

    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input wire:model="name" type="text" class="form-control @error('name')
      is-invalid
  @enderror"
            id="name" placeholder="Full Name" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input wire:model="email" type="text" class="form-control @error('email')
  is-invalid
@enderror"
            id="email" placeholder="user@gmail.com" name="email" value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    {{-- ------------------------------------------------------------------------ --}}
    {{-- Role --}}
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Role') }}</label>
        <select class="form-control" wire:model="role">
            <option value="">Silakan Pilih Role</option>
            <option value="Admin">Admin</option>
            <option value="Supervisor">Supervisor</option>
            <option value="Manager">Manager</option>
        </select>

        @error('role')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    {{-- Kota --}}
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Kota') }}</label>
        <select class="form-control" wire:model="kota_id">
            <option value="" selected>Silakan Pilih Kota</option>
            @foreach ($kota as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kota }}</option>
            @endforeach
        </select>

        @error('kota_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    {{-- Branch --}}
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Branch') }}</label>
        <select class="form-control" wire:model="branch_id">
            <option value="" selected>Silakan Pilih branch</option>

            @foreach ($branch as $b)
                <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
            @endforeach
        </select>

        @error('branch_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    {{-- ------------------------------------------------------------------------ --}}
    @if ($is_edit == false)
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input wire:model="password" type="text" class="form-control @error('password')
  is-invalid
@enderror"
                id="password" placeholder="Password" name="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmed Password</label>
            <input wire:model="password_confirmation" type="text"
                class="form-control @error('password_confirmation')
            is-invalid
          @enderror "
                placeholder="Confirm Password">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    @endif
    <div class="d-flex justify-content-between">
        <div>
            @if ($is_edit == false)
                <div class="mb-3 ">
                    <button class="btn btn-primary" wire:click="store">Register</button>
                </div>
            @else
                <div class="mb-3 ">
                    <button class="btn btn-primary" wire:click="update">Update</button>
                </div>
            @endif
        </div>
        <div class="mb-3 ">
            <button wire:click="cancel" class="btn btn-warning">Cancel</button>
        </div>
    </div>

    <hr>

</div>
{{-- </div> --}}
