<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pelita PDF</title>
</head>

<body>
    <h1 class="header">Data Umat Vihara</h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Mandarin</th>
                <th>Umur</th>
                <th>Telepon</th>
                <th>Handphone</th>
                <th>Alamat</th>
                <th>Pengajak</th>
                <th>Penjamin</th>
                {{-- <th>Pengajak</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($datapelita as $d)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $d->nama_umat }}</td>
                    <td>{{ $d->mandarin }}</td>
                    <td style="text-align:right">{{ $d->umur_sekarang }}</td>
                    <td>{{ $d->telp }}</td>
                    <td>{{ $d->hp }}</td>
                    <td>{{ $d->alamat }}</td>
                    <td>{{ $d->pengajak }}</td>
                    <td>{{ $d->penjamin }}</td>
                    {{-- <td>{{ $d->pengajak }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/main"><button>Back</button></a>
    <script>
        window.print();
    </script>
</body>
<style>
    /* @font-face {
            font-family: 'Comic Sans MS Custom';
            src: url('{{ asset('storage/fonts/DroidSansFallbackFull.ttf') }}') format("truetype");
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
      } */
    body {
        font-family: DejaVu Sans;
    }

    /* body {
        body { font-family: DejaVu Sans; }
        font-family: 'Droid Sans Fallback Full H', sans-serif
    } */

    .header {
        font-size: 2em;
        color: #A855F7;
        /* font-family: sans-serif; */
        text-align: center;
    }

    .styled-table {
        border-collapse: collapse;
        border-radius: 10px;
        margin: 25px 0;
        font-size: 0.9em;
        /* font-family: sans-serif; */
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
        background-color: #A855F7;
        border-radius: 10px;
        color: #ffffff;
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #A855F7;
    }
</style>

</html>
