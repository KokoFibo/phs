<div>
    <div class="d-flex justify-content-evenly mt-3">
        <div class="col-4">
            <div class="card">
                <div class="card-header">{{ __('Registration') }}</div>
                <div class="card-body">
                    @include('form_registration')
                </div>
            </div>
        </div>
        <div class="col-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Nama') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Role') }}</th>
                        <th>{{ __('Kota') }}</th>
                        <th>{{ __('Branch') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $d)
                        <tr>
                            <td>{{ $data->firstItem() + $index }}</td>
                            <td>{{ $d->id }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->role }}</td>
                            <td>{{ $d->nama_kota }}</td>
                            <td>{{ $d->nama_branch }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button wire:click="edit({{ $d->id }})" type="button"
                                        class="btn btn-warning">{{ __('Edit') }}</button>
                                    <button wire:click="delete({{ $d->id }})" type="button"
                                        class="btn btn-danger">{{ __('Delete') }}</button>
                                    <button wire:click="resetpassword({{ $d->id }})" type="button"
                                        class="btn btn-success">{{ __('Reset Password') }}</button>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
</div>
