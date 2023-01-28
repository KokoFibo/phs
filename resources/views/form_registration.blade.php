@if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif
{{-- <div class="container"> --}}
<div class="mt-1    p-3 shadow-lg rounded-xl  text-gray-700">
    {{-- <h5 class="mb-3">Registration : {{ $is_edit }}</h5>
    <hr> --}}

    <div class="w-full">
        <label for="name" class="block mb-2">{{ __('Nama') }}</label>
        <input wire:model="name" {{ $is_reset == true ? 'disabled' : '' }} type="text" class="w-full rounded-lg mb-4"
            id="name" placeholder="{{ __('Full Name') }}" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="block mb-2">{{ __('Email') }}</label>
        <input wire:model="email" {{ $is_reset == true ? 'disabled' : '' }} type="text"
            class="w-full rounded-lg mb-2" id="email" placeholder="user@gmail.com" name="email"
            value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    {{-- ------------------------------------------------------------------------ --}}
    {{-- Role --}}
    <div>
        <label for="email" class="block mb-2">{{ __('Role') }}</label>
        <select class="w-full rounded-lg mb-4" wire:model="role" {{ $is_reset == true ? 'disabled' : '' }}>
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
        <label for="email" class="block mb-2">{{ __('Kota') }}</label>
        <select class="w-full rounded-lg mb-2" wire:model="kota_id" {{ $is_reset == true ? 'disabled' : '' }}>
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
        <label for="email" class="block mb-2">{{ __('Branch') }}</label>
        <select class="w-full rounded-lg mb-2" wire:model="branch_id" {{ $is_reset == true ? 'disabled' : '' }}>
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
            <label for="password" class="block mb-2">{{ __('Password') }}</label>
            <input wire:model="password" type="text" class="w-full rounded-lg mb-2" id="password"
                placeholder="{{ __('Password') }}" name="password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-2">{{ __('Confirm Password') }}</label>
            <input wire:model="password_confirmation" type="text" class="w-full rounded-lg mb-4"
                placeholder="{{ __('Confirm Password') }}">
            @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
            @enderror

        </div>
    @endif
    <div class="flex justify-between">
        <div>
            @if ($is_reset == true)
                <div class="mb-3 ">
                    <button class="button button-blue" wire:click="storepassword">{{ __('Reset') }}</button>
                </div>
            @elseif ($is_edit == true)
                <div class="mb-3 ">
                    <button class="button button-blue" wire:click="update">{{ __('Update') }}</button>
                </div>
            @else
                <div class="mb-3 ">
                    <button class="button button-blue" wire:click="store">{{ __('Register') }}</button>
                </div>
            @endif
        </div>
        <div class="mb-3 ">
            <button wire:click="cancel" class="button button-orange">{{ __('Cancel') }}</button>
        </div>
    </div>

</div>
{{-- </div> --}}
