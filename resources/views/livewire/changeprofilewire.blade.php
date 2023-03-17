<div>
    @section('title', 'Change Profile')
    <div class="flex flex-col w-full gap-3 p-3 mt-3 lg:flex lg:flex-row lg:justify-evenly">
        <div class="w-full lg:w-1/4">
            <div class="w-full text-2xl font-semibold text-center text-purple-500">{{ __('Change Profile') }}</div>
            @include('form_changeprofile')
        </div>
        <div class="w-full lg:w-3/4">
            <div class="w-full text-2xl font-semibold text-center text-purple-500">{{ __('Profile Data') }}</div>
            <div class="overflow-x-auto">


                <table class="table w-full mx-auto mt-5 table-fixed lg:table-auto">
                    <thead>
                        <tr class="text-white bg-purple-500 ">
                            <th class="w-10 h-10 text-center border">#</th>
                            <th class="h-10 text-center border w-52">{{ __('Nama') }}</th>
                            <th class="h-10 text-center border w-60">{{ __('Email') }}</th>
                            <th class="w-40 h-10 text-center border">{{ __('Role') }}</th>
                            <th class="w-40 h-10 text-center border">{{ __('Kota') }}</th>
                            <th class="w-40 h-10 text-center border">{{ __('Group') }}</th>
                            <th class="w-40 h-10 text-center border">{{ __('Branch') }}</th>
                            {{-- <th class="h-10 text-center border">{{ __('Action') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            {{-- @if ((Auth::user()->role == '2' && $d->role != '3') || Auth::user()->role == '3') --}}
                            <tr>
                                <td class="h-10 text-center text-gray-700 border dark:text-white ">
                                    1
                                </td>
                                <td class="h-10 text-center text-gray-700 border dark:text-white ">{{ $d->name }}
                                </td>
                                <td class="h-10 text-center text-gray-700 border dark:text-white ">{{ $d->email }}
                                </td>
                                <td class="h-10 text-center text-gray-700 border dark:text-white ">
                                    {{ roleCheck($d->role) }}</td>
                                <td class="h-10 text-center text-gray-700 border dark:text-white ">
                                    {{ $d->kota->nama_kota }}</td>
                                <td class="h-10 text-center text-gray-700 border dark:text-white ">
                                    {{ $d->groupvihara->nama_group }}
                                </td>
                                <td class="h-10 text-center text-gray-700 border dark:text-white ">
                                    {{ $d->branch->nama_branch }}</td>

                            </tr>
                            {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2">
                {{-- {{ $data->links() }} --}}
            </div>
        </div>
        <hr class="invisible mt-5">
    </div>
    <hr class="mt-3">

</div>
