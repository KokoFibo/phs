<div class="p-3 mx-2 mt-1 text-gray-700 shadow-lg rounded-xl">
    {{-- <h5 class="mb-3">Registration : {{ $is_edit }}</h5>
      <hr> ax --}}
    @if ($is_edit == true)


        <div class="">
            <label for="name" class="block mb-2 dark:text-white">{{ __('Nama') }}</label>
            <input wire:model="name" {{ $is_reset == true ? 'disabled' : '' }} type="text"
                class="w-full mb-4 rounded-lg" id="name" placeholder="{{ __('Full Name') }}" name="name"
                value="{{ old('name') }}">
            @error('name')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror

        </div>

        <div class="mb-3">
            <label for="email" class="block mb-2 dark:text-white">{{ __('Email') }}</label>
            <input wire:model="email" {{ $is_reset == true ? 'disabled' : '' }} type="text"
                class="w-full mb-2 rounded-lg" id="email" placeholder="user@gmail.com" name="email"
                value="{{ old('email') }}">
            @error('email')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
        {{-- ------------------------------------------------------------------------ --}}
        {{-- Role --}}
        <div>
            <label for="email" class="block mb-2 dark:text-white">{{ __('Role') }}</label>
            <select class="w-full mb-4 rounded-lg" wire:model="role" {{ $is_reset == true ? 'disabled' : '' }}>
                <option value="">{{ __('Silakan Pilih Role') }}</option>
                <option value="0">{{ __('User') }}</option>
                <option value="1">{{ __('Admin') }}</option>
                <option value="2">{{ __('Supervisor') }}</option>
                @if (Auth::user()->role == '3')
                    <option value="3">{{ __('Manager') }}</option>
                @endif
            </select>

            @error('role')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
        {{-- Kota --}}
        <div class="mb-3">
            <label for="email" class="block mb-2 dark:text-white">{{ __('Kota') }}</label>
            <select class="w-full mb-2 rounded-lg" wire:model="kota_id" {{ $is_reset == true ? 'disabled' : '' }}>
                <option value="" selected>{{ __('Silakan Pilih Kota') }}</option>
                @foreach ($kota as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kota }}</option>
                @endforeach
            </select>

            @error('kota_id')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
        {{-- Group --}}
        <div class="mb-3">
            <label for="group" class="block mb-2 dark:text-white">{{ __('Group') }}</label>
            <select class="w-full mb-2 rounded-lg" wire:model="groupvihara_id"
                {{ $is_reset == true ? 'disabled' : '' }}>
                <option value="" selected>{{ __('Silakan Pilih Group') }}</option>

                @foreach ($group as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_group }}</option>
                @endforeach
            </select>

            @error('groupvihara_id')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        {{-- Branch --}}
        <div class="mb-3">
            <label for="email" class="block mb-2 dark:text-white">{{ __('Branch') }}</label>
            <select class="w-full mb-2 rounded-lg" wire:model="branch_id" {{ $is_reset == true ? 'disabled' : '' }}>
                <option value="" selected>{{ __('Silakan Pilih Branch') }}</option>

                @foreach ($branch as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_branch }}</option>
                @endforeach
            </select>

            @error('branch_id')
                <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
    @endif
    {{-- ------------------------------------------------------ax------------------ --}}

    @if ($is_reset == true)
        <div class="mb-3">
            <label for="Name" class="block mb-2 dark:text-white">{{ __('Name') }}</label>
            <input wire:model="name" type="text" disabled class="w-full mb-2 rounded-lg" id="Name">
        </div>
        <div class="mb-3">
            <label for="email" class="block mb-2 dark:text-white">{{ __('email') }}</label>
            <input wire:model="email" type="text" disabled class="w-full mb-2 rounded-lg" id="email">
        </div>

        <div x-data="{ showPassword: false }" class="relative mb-3">
            <label for="password" class="block mb-2 dark:text-white">{{ __('Password') }}</label>
            <input wire:model="password" :type="showPassword ? 'text' : 'password'" class="w-full mb-2 rounded-lg"
                id="password" placeholder="{{ __('Password') }}" name="password">
            <svg @click="showPassword = !showPassword" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="gray" class="absolute translate-y-1 bi bi-eye top-1/2 right-3" viewBox="0 0 16 16">
                <path
                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
            </svg>
        </div>
        @error('password')
            <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror

        <div x-data="{ showPassword: false }" class="relative mb-3">
            <label class="block mb-2 dark:text-white">{{ __('Confirm Password') }}</label>
            <input wire:model="password_confirmation" :type="showPassword ? 'text' : 'password'"
                class="w-full mb-4 rounded-lg" placeholder="{{ __('Confirm Password') }}">
            <svg @click="showPassword = !showPassword" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="gray" class="absolute translate-y-1 bi bi-eye top-1/2 right-3" viewBox="0 0 16 16">
                <path
                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
            </svg>
        </div>
    @endif

    @if ($is_edit == true || $is_reset == true)


        <div class="flex justify-between">
            <div>
                @if ($is_reset == true)
                    <div class="mb-3 ">
                        <button class="button button-blue" wire:click="storepassword">{{ __('Reset') }}</button>
                    </div>
                @endif
                @if ($is_edit == true)
                    <div class="mb-3 ">
                        <button class="button button-blue" wire:click="update">{{ __('Update') }}</button>
                    </div>
                @endif


            </div>
            <div class="mb-3 ">
                <button wire:click="cancel" class="button button-orange">{{ __('Cancel') }}</button>
            </div>
        </div>
    @endif

</div>
{{-- </div> --}}
