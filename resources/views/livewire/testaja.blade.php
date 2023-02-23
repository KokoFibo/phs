<div>
      {{ $gabung[0]->nama_group }}
      <table>
            <thead>
                  <tr>
                        <th>Group</th>

                  </tr>
            </thead>
            <tbody>

                  @foreach ($gabung as $index=>$g)
                  <tr>
                        <td>{{ $index +1 }}</td>
                        <td>{{ $g->nama_umat }}</td>
                        <td>{{ $g->nama_kota }}</td>
                        <td>{{ $g->nama_pandita }}</td>
                        <td>{{ $g->nama_branch }}</td>
                  </tr>
                  @endforeach
                  << /td>


            </tbody>

      </table>
</div>
