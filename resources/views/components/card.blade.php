<div>
    {{-- <div
        class="transform hover:scale-125 w-44 h-22  bg-purple-50  {{ $textcolor }} border-b-4 rounded-xl {{ $bordercolor }} shadow-xl flex flex-col justify-around items-center ">
        <div>
        </div>
        <div>
            <h2 class="{{ $textcolor }} font-bold text-center text-2xl">{{ $bigtext }}</h2>
        </div>
        <div>
            <h2 class=" {{ $textcolor }} text-center text">{{ $smalltext }}</h2>
        </div>
    </div> --}}

    <div class="card  border border-end-0 border-top-0 border-bottom-0 border-5 border-{{ $bordercolor }}">
        <div class="rounded shadow card-body">
            <h1 class="text-center text-{{ $textcolor }} ">{{ $bigtext }}</h1>
            <p class="text-center text-{{ $textcolor }}" style="font-size: 15px">
                {{ $smalltext }}
            </p>
        </div>
    </div>

</div>