<div>
    <div
        class="transform hover:scale-125 w-44 h-44 bg-white   {{ $textcolor }} border-b-8 rounded-xl {{ $bordercolor }} shadow-xl flex flex-col justify-around items-center ">
        <div>
        </div>
        <div>
            <h2 class="{{ $textcolor }} font-bold text-center text-5xl">{{ $bigtext }}</h2>
        </div>
        <div>
            <h2 class=" {{ $textcolor }} text-center text-xl">{{ $smalltext }}</h2>
        </div>
    </div>
    <style>
        .glass {
            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</div>

{{-- <x-card textcolor:"text-purple-500" bordercolor:"border-purple-500" bigtext="$totalUmat"
    smalltext="Umat"</div> --}}
