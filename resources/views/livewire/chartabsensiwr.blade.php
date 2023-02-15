<div>
    <div class="w-1/2 mx-auto mt-10 text-center bg-white">
        {{ $this->selectedKelasId }}
        <h1 class="text-5xl text-pink-500">CHart KElas .... </h1>
        <canvas id="myChart"></canvas>
    </div>
    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var chartData = JSON.parse(`<?php echo $dataAbsensi; ?>`);
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
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