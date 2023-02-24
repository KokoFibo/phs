<div class="bg-purple-100 ">

      @section('title', 'Dashboard')
      {{-- first row --}}

      @if (Auth::user()->role == 0)
      @include('userinfo')
      @else
      @include('frontdashboard')

      <div class="h-3"></div>
      <div x-data="{ open : false}">
            @if ($selectedBranch != null)

            <span><button @click="open = !open" wire:click="tampilchart" class="p-3 m-5 button button-teal">Tampilkan Chart</button></span>
            @endif
            <div x-show="open">

                  {{-- select box Kelas--}}
                  <div class="relative inline-flex ">
                        {{-- <svg class="absolute top-0 right-0 w-2 h-2 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232">
                              <path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero" />
                        </svg> --}}
                        {{-- <select wire:model="selectedKelasId" class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none"> --}}
                        <select wire:model="selected" class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none">
                              <option value="">{{ __('Pilih Kelas') }}</option>
                              @foreach ($selectedDaftarKelas_id as $sdk)
                              <option value="{{ $sdk }}">{{ getNamaKelas($sdk) }}</option>
                              {{-- <option value="{{ $sdk }}">{{ $sdk->kelas->nama_kelas }}</option> --}}
                              @endforeach
                        </select>
                        {{-- </div> --}}
                        {{-- select box Tahun--}}
                        <div class="relative inline-flex ">
                              <select wire:model="selectedYear" class="h-10 pl-5 pr-10 text-gray-600 bg-white border border-gray-300 rounded-full appearance-none hover:border-gray-400 focus:outline-none">
                                    {{-- <option value="{{ date('Y') }}" selected>{{ date('Y') }}</option> --}}
                                    <option value="">{{ $selectedYear }}</option>
                                    @foreach ($years as $year)
                                    <option value="{{ $year->year }}">{{ $year->year }}</option>
                                    @endforeach
                              </select>
                        </div>


                        {{-- select box end --}}

                        <div class="w-[800px] mx-auto mt-5  bg-white rounded-xl shadow-2xl p-5">


                              <h2 class="p-5 text-2xl text-center text-purple-500">{{ getNamaCetya($selected) }} - {{ getNamaKelas($selected) }}</h2>

                              <canvas id="myChart" width="800" height="500"></canvas>
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
            type: 'line'
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
