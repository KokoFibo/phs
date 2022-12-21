<h1>hello propinsi</h1>
<table>
    @foreach ($propinsi as $p)
        <tr>
            <td>{{ $p->nama }}</td>
        </tr>
    @endforeach
</table>
