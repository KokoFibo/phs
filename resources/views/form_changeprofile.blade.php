@if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
@endif
{{-- <div class="container"> --}}
<div class="p-3 mt-1 text-gray-700 shadow-lg rounded-xl">

    <div class="mb-3">
        <label class="block mb-2 dark:text-white">{{ __('Nama') }}</label>
        <input wire:model="name" type="text" class="w-full mb-2 rounded-lg">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <button wire:click="updatename()" class=" button button-purple">{{ __('Update Name') }}</button>
    </div>

    <hr>

    <div class="mt-3 mb-3">
        <label class="block mb-2 dark:text-white">{{ __('Email') }}</label>
        <input wire:model="email" type="text" class="w-full mb-2 rounded-lg">
        @error('email')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
        <button wire:click="updateemail()" class=" button button-purple">{{ __('Update Email') }}</button>
    </div>

    <hr>

    <div class="mt-3 mb-3 ">
        <label class="block mb-2 dark:text-white">{{ __('Current Password') }}</label>
        <input wire:model="curr_pass" type="password" class="w-full mb-2 rounded-lg">

        @error('curr_pass')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>
    <div x-data="{ showPassword: false }" class="relative mb-3">
        <label class="block mb-2 dark:text-white">{{ __('New Password') }}</label>
        <input wire:model="password" :type="showPassword ? 'text' : 'password'" class="w-full mb-2 rounded-lg">
        <svg @click="showPassword = !showPassword" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
            fill="gray" class="absolute translate-y-1 bi bi-eye top-1/2 right-3" viewBox="0 0 16 16">
            <path
                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
        </svg>
        @error('password')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div x-data="{ showPassword: false }" class="relative mb-3">
        <label class="block mb-2 dark:text-white">{{ __('Confirm Password') }}</label>
        <input wire:model="password_confirmation" :type="showPassword ? 'text' : 'password'"
            class="w-full mb-2 rounded-lg">
        <svg @click="showPassword = !showPassword" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
            fill="gray" class="absolute translate-y-1 bi bi-eye top-1/2 right-3" viewBox="0 0 16 16">
            <path
                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
        </svg>
        @error('password_confirmation')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

    </div>
    {{-- @endif --}}
    <div class="flex justify-between">
        <div>
            <button class="button button-purple" wire:click="changePassword">{{ __('Change Password') }}</button>

        </div>
        <div class="mb-3 ">
            <button wire:click="close" class="button button-black">{{ __('Close') }}</button>
        </div>
    </div>

</div>
{{-- </div> --}}
