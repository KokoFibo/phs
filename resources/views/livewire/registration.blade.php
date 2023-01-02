<div>
    <div class="d-flex justify-content-evenly mt-3">
        <div class="col-4">
            <div class="card">
                <div class="card-header">Registration</div>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Kota</th>
                        <th>Branch</th>
                        <th>Action</th>
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
                                        class="btn btn-warning">Edit</button>
                                    <button wire:click="delete({{ $d->id }})" type="button"
                                        class="btn btn-danger">Delete</button>

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
