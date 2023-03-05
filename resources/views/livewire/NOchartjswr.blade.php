<div>

      <h1 class="text-5xl text-pink-500">Livewire with Chart JS</h1>
      <div style="width: 800px">
            <span>daftar kelas</span>
            <select class="border" wire:model="selected">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
            </select>
            <button wire:click="ubahChart" class="button button-teal">Ubah Chart</button>
            <div class="mt-5 w-72">

                  <canvas id="myChart" width="400" height="400"></canvas>
            </div>
      </div>
      @push('script')
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      {{-- Chart  3.7.1 --}}
      <script>
            var chartData = JSON.parse(`<?php echo $dataAbsensi; ?>`);


            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                  type: 'bar'
                  , data: {
                        labels: chartData.label
                        , datasets: [{
                              label: '# of Votes'
                              , data: chartData.data
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
            Livewire.on('updatedata', event => {
                  var chartData = JSON.parse(event.data);
                  //   console.log(chartData);
                  myChart.data.labels = (chartData.label);
                  myChart.data.datasets.forEach((dataset) => {
                        dataset.data = (chartData.data);
                  });
                  myChart.update();
            });

      </script>

      @endpush
</div>
