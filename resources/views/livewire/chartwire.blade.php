<div>
    <p>{{ $dataPeserta[0] }}, {{ $dataPeserta[1] }}, {{ $dataPeserta[2] }} </p>
    {{-- {{ dd($dataX, $dataY, $dataXjson, $dataYjson) }} --}}
    {{-- @if ($dataY && $dataX)

    @foreach ($dataY as $y )
    <ul>
        <li>{{ $y }}</li>
    </ul>
    @endforeach
    @foreach ($dataX as $x )
    <ul>
        <li>{{ $x }}</li>
    </ul>
    @endforeach
    @endif --}}

    <select wire:model="selectedGroupVihara">
        <option value="">Pilih Group</option>
        @foreach ($groupvihara as $g )
        <option value="{{ $g->id }}">{{ $g->nama_group }}</option>
        @endforeach
    </select>

    <select wire:model="selectedDaftarKelasId">
        <option value="">Pilih Kelas</option>
        @foreach ($daftarkelas as $d )
        {{-- <option value="{{ $d->id }}">{{ getDaftarKelas($d->kelas_id) }}</option> --}}
        <option value="{{ $d->id }}">{{ getDaftarKelas($d->id) }}</option>
        {{-- <option value="{{ $d->id }}">{{ $d->kelas_id }}</option> --}}
        @endforeach
    </select>

    <button wire:click="updateChart" class="button button-blue">Proses</button>

    {{-- @if($openchart) --}}


    <div style="width:400px">
        <canvas id="myChart"></canvas>
    </div>
    <div style="width:400px">
        <canvas id="myChart1"></canvas>
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
                              label: '# of Votes'
                              , data: peserta
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
                        scales: {
                              y: {
                                    beginAtZero: true
                              }
                        },
                  }
            });


            Livewire.on('berhasilUpdate', event => {
                var tanggal = JSON.parse(event.dataXjson);
                var peserta = JSON.parse(event.dataYjson);
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
                        labels: (['Vegetarian Total','Sidang Dharma 3 Hari', 'Belum Keduanya'])
                        , datasets: [{
                              label: '# of Votes'
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
    {{-- @endif --}}
</div>