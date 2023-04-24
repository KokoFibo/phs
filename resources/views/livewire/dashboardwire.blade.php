<div>


    @section('title', 'Dashboard')
    @if (Auth::user()->role == 0)
        @include('userinfo')
    @else
        <x-spinner />

        @include('layouts.navbardashboard')

        {{-- @include('layouts.navbarresponsive') --}}

        <div class="container-fluid">

            <style>
                body {
                    background-color: rgb(243, 232, 255);
                }
            </style>
            @include('frontdashboard')
            <div class="p-2 mt-2 row ">
                <div class="text-center col">
                    @if ($selectedGroupVihara != null)
                        <h4 style="color:rgb(236,72,153)">{{ getDaftarKelas($selectedDaftarKelasId) }} -
                            {{ getGroupVihara($selectedGroupVihara) }}</h4>
                    @else
                        <h4 style="color:rgb(236,72,153)">-</h4>
                    @endif
                </div>
            </div>
            {{-- chart start --}}
            <div class="p-2 mt-1 row">
                <div class="mb-2 col-xl-3 ">
                    <div class="card">
                        <div class="w-auto rounded shadow card-body" style=" background-color: white;">
                            <h5 class="text-center">{{ __('Data Absensi Terakhir') }}</h5>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    {{ __('Tanggal') }} : {{ tanggal($tglAbsensiTerakhir) }}
                                </li>
                                <li class="list-group-item">
                                    {{ __('Total Peserta') }} : {{ $totalPeserta }} {{ __('Orang') }}
                                </li>
                                <li class="list-group-item">
                                    {{ __('Peserta yang Hadir') }} : {{ $jumlahPesertaAbsensiTerakhir }}
                                    {{ __('Orang') }}
                                </li>

                                <li class="list-group-item">
                                    {{ __('Kelas 3 Hari') }} : {{ $Sd3hAbsensiTerakhir }} {{ __('Orang') }}
                                    ({{ number_format($Sd3hAbsensiTerakhirPersen, 1) }}%)
                                </li>
                                <li class="list-group-item">
                                    {{ __('Vegetarian Total') }} : {{ $VTotalAbsensiTerakhir }} {{ __('Orang') }}
                                    ({{ number_format($VTotalAbsensiTerakhirPersen, 1) }}%)
                                </li>
                                <li class="list-group-item">
                                    {{ __('Lainnya') }} : {{ $LainnyaAbsensiTerakhir }} {{ __('Orang') }}
                                </li>

                                <li class="list-group-item">
                                    {{ __('Laki-laki') }} : {{ $lakiAbsensiTerakhir }} {{ __('Orang') }}
                                </li>
                                <li class="list-group-item">
                                    {{ __('Perempuan') }} : {{ $perempuanAbsensiTerakhir }} {{ __('Orang') }}
                                </li>
                                <li class="list-group-item">
                                    {{ __('Persentase Kehadiran') }} :
                                    {{ number_format($persentaseKehadiranAbsensiTerakhir, 1) }}%
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="mb-2 mr-3 lg-mt-1 col-xl-3">
                    <h5>{{ __('Informasi Kelas') }}</h5>
                    <div
                        style="position: relative; background-color: white; padding:10px; border-radius: 20px;
                border: solid 3px rgb(236,72,153);">
                        <canvas id="myChart1"></canvas>
                    </div>
                </div>
            </div>
            <div class="p-2 mt-1 row">
                <h5>{{ __('Informasi Kehadiran Peserta') }}</h5>
                <div class="mb-2 col-12 col-xl-6 ">
                    <div
                        style=" background-color: white; padding:10px; border-radius: 20px;
                border: solid 3px rgb(236,72,153);">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            <hr class="hidden mt-5">


            @push('script')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script
                    src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js"
                    integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w=="
                    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                    var tanggal = JSON.parse(`<?php echo $dataXjson; ?>`);
                    var peserta = JSON.parse(`<?php echo $dataYjson; ?>`);
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: tanggal,
                            datasets: [{
                                label: '# Peserta (班員)',
                                data: peserta,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        },
                        plugins: [ChartDataLabels],
                        options: {
                            // ...
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
                        type: 'doughnut',
                        data: {
                            // labels: tanggal
                            labels: (['Vegetarian Total (清口)', 'Sidang Dharma 3 Hari (三天法會)', 'Belum Keduanya (沒有任何)']),
                            datasets: [{
                                label: '# Peserta',
                                data: detailPeserta,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },

                        },
                        plugins: [ChartDataLabels],
                        options: {
                            // ...
                        }
                    });


                    Livewire.on('berhasilUpdate', event => {
                        var tanggal = JSON.parse(event.dataXjson);
                        var peserta = JSON.parse(event.dataYjson);
                        var detailPeserta = JSON.parse(event.dataYjsonPeserta);

                        console.log(tanggal, peserta);
                        myChart1.data.labels = (['Vegetarian Total', 'Sidang Dharma 3 Hari', 'Belum Keduanya']);
                        myChart1.data.datasets.forEach((dataset) => {
                            dataset.data = (detailPeserta);
                        });
                        myChart1.update();
                    });
                </script>
            @endpush
            {{-- Chart End --}}
    @endif

    {{-- end if dari awal utk role selain 0 --}}
</div>
</div>
