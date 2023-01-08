<div>
    @section('title', 'Dashboard')
    <div class="flex">
        <div class="kartu">
            <h1>{{ $totalUmat }}</h1>
            <hr>
            <h5>Umat</h5>
        </div>
        <div class="kartu">
            <h1>{{ $umatActive }}</h1>
            <hr>
            <h5>Umat Active</h5>
        </div>
        <div class="kartu">
            <h1>{{ $umatInactive }}</h1>
            <hr>
            <h5>Umat Inactive</h5>
        </div>
        <div class="kartu">
            <h1>{{ $umatYTD }}</h1>
            <hr>
            <h5>Umat {{ getYear() }}</h5>
        </div>

    </div>
    <div class="flex">
        <div class="kartu">
            <h1>{{ $totalBranch }}</h1>
            <hr>
            <h5>Cetya</h5>
        </div>
        <div class="kartu">
            <h1>{{ $totalPandita }}</h1>
            <hr>
            <h5>Pandita</h5>
        </div>
        <div class="kartu">
            <h1>000</h1>
            <hr>
            <h5>Kota</h5>
        </div>
        <div class="kartu">
            <h1>000</h1>
            <hr>
            <h5>Future Data</h5>
        </div>

    </div>

    <style>
        .kartu {
            margin-top: 30px;
            padding: 20px;
            width: 200px;
            border: solid 0.1px black;
            border-radius: 15px;
            box-shadow: 5px 5px black;

        }

        .flex {
            display: flex;
            justify-content: space-evenly;
        }

        h1,
        h5 {
            text-align: center;
        }

        h5 {}
    </style>
</div>
