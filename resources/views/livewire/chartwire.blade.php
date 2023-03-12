<div>
    total jumnlah {{ $jumlah }}

    <table class="text-black bg-green-100 table-auto">
        <thead>
            <tr>
                <th>id</th>
                <th>Nama</th>
                <th>Vihara</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    <td>{{ $b->nama_umat }}</td>
                    <td>{{ $b->branch_id }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {{ $data->links() }} --}}
    <ul>


    </ul>
</div>
