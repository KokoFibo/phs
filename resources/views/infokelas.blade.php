{{-- <p>selected branch = {{ getBranch($selectedBranch) }}</p> --}}
<div>
    {{-- <x-card smalltext="Umat" bigtext="{{ $totalUmat_sp }}" textcolor="text-purple-500"
        bordercolor="border-purple-500" /> --}}
    {{-- @dump($selectedDaftarKelas_id) --}}
    <h1 class="my-5 font-semibold text-center text-black text-7xl">{{ getBranch($selectedBranch) }}</h1>
    @foreach ($selectedDaftarKelas_id as $item)
        {{-- <p>Nama Kelas : {{ getNamaKelas($item) }} </p> --}}
        <x-absensicard judul="{{ getNamaKelas($item) }}"
            content="Some quick example text to build on the card title and make up the bulk of the card's
        content." />
    @endforeach
    <div style="width: 800px">
        <h1 class="text-5xl text-pink-500">Livewire with Chart JS</h1>
        <canvas id="myChart"></canvas>
    </div>

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var chartData = JSON.parse(`<?php echo $dataAbsensi; ?>`);
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.label,
                    datasets: [{
                        label: '# of Votes',
                        data: chartData.data,
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush

</div>
