<div>
    <div class="flex justify-evenly mt-3 mx-2">
        <div class="w-1/4">
            <div class="w-full text-center text-2xl font-semibold text-purple-500">{{ __('Registration') }}</div>
            @include('form_registration')
        </div>
        <div class="w-3/4 ml-3">
            <div class="w-full text-center text-2xl font-semibold text-purple-500">{{ __('Data User') }}</div>
            <table class="w-full table mx-auto mt-5">
                <thead>
                    <tr class="bg-purple-500 text-white ">
                        <th class="text-center h-10 border">#</th>
                        <th class="text-center h-10 border">{{ __('Nama') }}</th>
                        <th class="text-center h-10 border">{{ __('Email') }}</th>
                        <th class="text-center h-10 border">{{ __('Role') }}</th>
                        <th class="text-center h-10 border">{{ __('Kota') }}</th>
                        <th class="text-center h-10 border">{{ __('Branch') }}</th>
                        <th class="text-center h-10 border">{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $d)
                        <tr>
                            <td class="text-gray-700 h-10 text-center border ">
                                {{ $data->firstItem() + $index }}
                            </td>
                            <td class="text-gray-700 h-10 text-center border ">{{ $d->name }}</td>
                            <td class="text-gray-700 h-10 text-center border ">{{ $d->email }}</td>
                            <td class="text-gray-700 h-10 text-center border ">{{ $d->role }}</td>
                            <td class="text-gray-700 h-10 text-center border ">{{ $d->nama_kota }}</td>
                            <td class="text-gray-700 h-10 text-center border ">{{ $d->nama_branch }}</td>
                            <td class="text-gray-700 h-10 text-center border  ">
                                <div class="text-center">
                                    <button wire:click="edit({{ $d->id }})"
                                        class="bg-orange-500 text-black text-sm px-2 py-1 rounded">{{ __('Edit') }}</button>
                                    <button wire:click="delete({{ $d->id }})"
                                        class="bg-red-500 text-white text-sm px-2 py-1 rounded">{{ __('Delete') }}</button>
                                    <button wire:click="resetpassword({{ $d->id }})"
                                        class="bg-teal-500 text-white text-sm px-2 py-1 rounded">{{ __('Reset') }}</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-2">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
