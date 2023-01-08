@if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif
{{-- <div class="container"> --}}
<div class="mt-1 mx-auto  p-3 shadow-lg rounded-5" style="border-radius: 15px">
    {{-- <h5 class="mb-3">Registration : {{ $is_edit }}</h5>
    <hr> --}}

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Nama') }}</label>
        <input wire:model="name" {{ $is_reset == true ? 'disabled' : '' }} type="text"
            class="form-control @error('name')
      is-invalid
  @enderror" id="name"
            placeholder="{{ __('Full Name') }}" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input wire:model="email" {{ $is_reset == true ? 'disabled' : '' }} type="text"
            class="form-control @error('email')
  is-invalid
@enderror" id="email" placeholder="user@gmail.com"
            name="email" value="{{ old('email') }}">
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
        <select class="form-control" wire:model="role" {{ $is_reset == true ? 'disabled' : '' }}>
            <option value="">{{ __('Silakan Pilih Role') }}</option>
            <option value="1">{{ __('Admin') }}</option>
            <option value="2">{{ __('Supervisor') }}</option>
            <option value="3">{{ __('Manager') }}</option>
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
        <select class="form-control" wire:model="kota_id" {{ $is_reset == true ? 'disabled' : '' }}>
            <option value="" selected>{{ __('Silakan Pilih Kota') }}</option>
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
        <select class="form-control" wire:model="branch_id" {{ $is_reset == true ? 'disabled' : '' }}>
            <option value="" selected>{{ __('Silakan Pilih Branch') }}</option>

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
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input wire:model="password" type="text" class="form-control @error('password')
  is-invalid
@enderror"
                id="password" placeholder="{{ __('Password') }}" name="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('Confirm Password') }}</label>
            <input wire:model="password_confirmation" type="text"
                class="form-control @error('password_confirmation')
            is-invalid
          @enderror "
                placeholder="{{ __('Confirm Password') }}">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    @endif
    <div class="d-flex justify-content-between">
        <div>
            @if ($is_reset == true)
                <div class="mb-3 ">
                    <button class="btn btn-primary" wire:click="storepassword">{{ __('Reset') }}</button>
                </div>
            @elseif ($is_edit == true)
                <div class="mb-3 ">
                    <button class="btn btn-primary" wire:click="update">{{ __('Update') }}</button>
                </div>
            @else
                <div class="mb-3 ">
                    <button class="btn btn-primary" wire:click="store">{{ __('Register') }}</button>
                </div>
            @endif
        </div>
        <div class="mb-3 ">
            <button wire:click="cancel" class="btn btn-warning">{{ __('Cancel') }}</button>
        </div>
    </div>

    <hr>

</div>
{{-- </div> --}}
