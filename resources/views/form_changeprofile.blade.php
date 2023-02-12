@if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif
{{-- <div class="container"> --}}
<div class="p-3 mt-1 text-gray-700 shadow-lg rounded-xl">
    {{-- <h5 class="mb-3">Registration : {{ $is_edit }}</h5>
    <hr> --}}

    <div class="mb-3">
        <label class="block mb-2">{{ __('Nama') }}</label>
        <input wire:model="name" type="text" class="w-full mb-2 rounded-lg">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <button wire:click="updatename()" class=" button button-teal">{{ __('Update Name') }}</button>
    </div>

    <hr>

    <div class="mt-3 mb-3">
        <label class="block mb-2">{{ __('Email') }}</label>
        <input wire:model="email" type="text" class="w-full mb-2 rounded-lg">
        @error('email')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
        <button wire:click="updateemail()" class=" button button-teal">{{ __('Update Email') }}</button>
    </div>

    <hr>

    <div class="mt-3 mb-3">
        <label class="block mb-2">{{ __('Current Password') }}</label>
        <input wire:model="curr_pass" type="password" class="w-full mb-2 rounded-lg">
        @error('curr_pass')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="block mb-2">{{ __('New Password') }}</label>
        <input wire:model="password" type="password" class="w-full mb-2 rounded-lg">
        @error('password')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="block mb-2">{{ __('Confirm Password') }}</label>
        <input wire:model="password_confirmation" type="password" class="w-full mb-4 rounded-lg">
        @error('password_confirmation')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

    </div>
    {{-- @endif --}}
    <div class="flex justify-between">
        <div>
            <button class="button button-teal" wire:click="changePassword">{{ __('Change Password') }}</button>

        </div>
        <div class="mb-3 ">
            <button wire:click="close" class="button button-orange">{{ __('Close') }}</button>
        </div>
    </div>

</div>
{{-- </div> --}}
