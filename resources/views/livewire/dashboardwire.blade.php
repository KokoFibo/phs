<div class="bg-purple-100 ">

      @section('title', 'Dashboard')
      {{-- first row --}}

      @if (Auth::user()->role == 0)
      @include('userinfo')
      @else
      @include('frontdashboard')


      <div x-data="{ open : false}">

            <span><button @click="open = !open" wire:click="tampilchart" class="button button-teal">Tampilkan Chart</button></span>
            <div x-show="open">

                  {{-- select box --}}
                  <div class="relative inline-flex ">
                        <svg class="absolute top-0 right-0 w-2 h-2 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                              <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero" />
                        </svg>
                        {{-- <select wire:model="selectedKelasId" class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none"> --}}
                        <select wire:model="selected" class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none">
                              <option value="">{{ __('Pilih Kelas') }}</option>
                              @foreach ($selectedDaftarKelas_id as $sdk)
                              <option value="{{ $sdk }}">{{ getNamaKelas($sdk) }}</option>
                              {{-- <option value="{{ $sdk }}">{{ $sdk->kelas->nama_kelas }}</option> --}}
                              @endforeach
                        </select>
                  </div>


                  {{-- select box end --}}

                  {{-- <button wire:click="ubahChart" class="button button-teal">Ubah Chart</button> --}}
                  <div class="mt-5 bg-white w-72">

                        <canvas id="myChart" width="400" height="400"></canvas>
                  </div>
                  {{-- untuk panggil chart END --}}
            </div>
            {{-- untuk panggil chart --}}
      </div>

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
                              'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'
                              , 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'
                        ]
                        , borderColor: [
                              'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'
                              , 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
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
@endif
</div>
