<div class="container-fluid">
    <style>
        body {
            background-color: rgb(243, 232, 255);
        }
    </style>

    @section('title', 'Dashboard')
    @if (Auth::user()->role == 0)
    @include('userinfo')
    @else
    <div class="py-2 text-center rounded shadow " style="color: white; background-color:rgb(236,72,153)">
        <div class="row align-items-center">
            <div class="col-xl-1">

            </div>
            <div class="text-center col-xl-8">
                <h2>Vihara Pelita Hati Suci</h2>
                <p>selectedGroupVihara: {{ $selectedGroupVihara }}</p>
                <p>selectedDaftarKelasId: {{ $selectedDaftarKelasId }}</p>
            </div>

            <div class="my-2 col-xl-1">
                <a href="{{ route('main') }}"><button class="btn btn-warning">Enter</button></a>
            </div>
            <div class="my-2 col-xl-1">
                @if (app()->getLocale() == 'id')
                <a class="block dropdown-item" href="{{ url('locale/cn') }}"><i class="fa fa-language fa-2xl"></i></a>
                @endif

                @if (app()->getLocale() == 'cn')
                <a class="block dropdown-item" href="{{ url('locale/id') }}"><i class="fa fa-language fa-2xl"></i></a>
                @endif
            </div>
            <div class="my-2 col-xl-1">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        style="color: white" class="fa-sharp fa-solid fa-power-off fa-xl"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
                    @csrf
                </form>
            </div>

        </div>
    </div>
    @include('frontdashboard')

    <div class="p-2 mt-2 row ">
        <div class="mb-2 col-xl-3">
            <select class="shadow form-select" wire:model="selectedDaftarKelasId">
                <option value="">Pilih Kelas</option>
                @foreach ($daftarkelas as $d )
                <option value="{{ $d->id }}">{{ getDaftarKelas($d->kelas_id) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-xl-2">
            <button wire:click="updateChart" class="shadow btn btn-primary">{{ __('Proses Chart') }}</button>
        </div>
    </div>
    <div class="p-2 mt-1 row">
        <div class="mb-2 col-xl-3 ">
            <div class="card">
                <div class="w-auto rounded shadow card-body" style=" background-color: white;">
                    <h5>{{ __('Data Absensi Terakhir') }}</h5>
                    <hr>
                    <p>{{ __('Tanggal') }} : 06 Mar 2023</p>
                    <p>{{ __('Jumlah Peserta') }} : 20 {{ __('Orang') }}</p>
                    <p>{{ __('Sidang Dharma 3 Hari') }} : 3 {{ __('Orang') }} (15%)</p>
                    <p>{{ __('Vegetarian Total') }} : 3 {{ __('Orang') }} (15%)</p>
                    <p>{{ __('Lainnya') }} : 16 {{ __('Orang') }}</p>
                    <p>{{ __('Laki-laki') }} : 16 {{ __('Orang') }}</p>
                    <p>{{ __('Perempuan') }} : 16 {{ __('Orang') }}</p>
                    <p>{{ __('Persentase Kehadiran') }} : 80%</p>
                </div>
            </div>

        </div>
        <div class="mb-2 col-xl-3">
            <div class="w-auto p-1 rounded shadow card-body" style=" background-color: white;">
                <canvas id="myChart1"></canvas>
            </div>

        </div>
        <div class="mb-2 col-xl-6">
            <div class="w-auto p-1 rounded shadow card-body" style="background-color: white;">
                <canvas id="myChart"></canvas>
            </div>
        </div>

    </div>


    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var tanggal = JSON.parse(`<?php echo $dataXjson; ?>`);
        var peserta = JSON.parse(`<?php echo $dataYjson; ?>`);
        const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                  type: 'bar'
                  , data: {
                        labels: tanggal
                        , datasets: [{
                              label: '# Peserta (班員)'
                              , data: peserta
                              , backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)'
                                    , 'rgba(54, 162, 235, 0.2)'
                                    , 'rgba(255, 206, 86, 0.2)'
                                    , 'rgba(75, 192, 192, 0.2)'
                                    , 'rgba(153, 102, 255, 0.2)'
                                    , 'rgba(255, 159, 64, 0.2)'
                              ]
                              ,   borderColor: [
                                    'rgba(255, 99, 132, 1)'
                                    , 'rgba(54, 162, 235, 1)'
                                    , 'rgba(255, 206, 86, 1)'
                                    , 'rgba(75, 192, 192, 1)'
                                    , 'rgba(153, 102, 255, 1)'
                                    , 'rgba(255, 159, 64, 1)'
                              ]
                              , borderWidth: 1
                        }]
                  }
                  , options: {
                    responsive:true,
                        scales: {
                              y: {
                                    beginAtZero: true
                              }
                        }
                  }
            });


            Livewire.on('berhasilUpdate', event => {
                var tanggal = JSON.parse(event.dataXjson);
                var peserta = JSON.parse(event.dataYjson);
                console.log(tanggal, peserta);
                  myChart.data.labels = (tanggal);
                  myChart.data.datasets.forEach((dataset) => {
                        dataset.data = (peserta);
                  });
                  myChart.update();
            });

    </script>
    {{-- pie Chart --}}
    <script>
        var tanggal = JSON.parse(`<?php echo $dataXjson; ?>`);
        var peserta = JSON.parse(`<?php echo $dataYjson; ?>`);
        var detailPeserta = JSON.parse(`<?php echo $dataYjsonPeserta; ?>`);
        const ctx1 = document.getElementById('myChart1').getContext('2d');
            const myChart1 = new Chart(ctx1, {
                  type: 'pie'
                  , data: {
                        // labels: tanggal
                        labels: (['Vegetarian Total (清口)','Sidang Dharma 3 Hari (三天法會)', 'Belum Keduanya (沒有任何)'])
                        , datasets: [{
                              label: '# Peserta'
                              , data: detailPeserta
                              , backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)'
                                    , 'rgba(54, 162, 235, 0.2)'
                                    , 'rgba(255, 206, 86, 0.2)'
                                    , 'rgba(75, 192, 192, 0.2)'
                                    , 'rgba(153, 102, 255, 0.2)'
                                    , 'rgba(255, 159, 64, 0.2)'
                              ]
                              , borderColor: [
                                    'rgba(255, 99, 132, 1)'
                                    , 'rgba(54, 162, 235, 1)'
                                    , 'rgba(255, 206, 86, 1)'
                                    , 'rgba(75, 192, 192, 1)'
                                    , 'rgba(153, 102, 255, 1)'
                                    , 'rgba(255, 159, 64, 1)'
                              ]
                              , borderWidth: 1
                        }]
                  }
                  , options: {
                        responsive:true,
                        scales: {
                              y: {
                                    beginAtZero: true
                              }
                        }
                  }
            });


            Livewire.on('berhasilUpdate', event => {
                var tanggal = JSON.parse(event.dataXjson);
                var peserta = JSON.parse(event.dataYjson);
                var detailPeserta = JSON.parse(event.dataYjsonPeserta);

                console.log(tanggal, peserta);
                  myChart1.data.labels = (['Vegetarian Total','Sidang Dharma 3 Hari', 'Belum Keduanya']);
                  myChart1.data.datasets.forEach((dataset) => {
                        dataset.data = (detailPeserta);
                  });
                  myChart1.update();
            });

    </script>
    @endpush
    @endif

    {{-- end if dari awal utk role selain 0 --}}
</div>