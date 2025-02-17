<?php

namespace App\Http\Livewire;

use App\Models\DataPelita;
use Livewire\Component;

class Test extends Component
{
    public function render()
    {
        $date = "2025/02/17";
        // dd(convertToLunar($date));
        // $data = DataPelita::select(['id', 'tgl_mohonTao', 'tgl_mohonTao_lunar'])->get();
        // foreach ($data as $d) {
        //     $d->tgl_mohonTao_lunar = convertToLunar($d->tgl_mohonTao);
        //     // dd($d);
        //     $d->save();
        // }


        dd(lunarInChinese($date));

        return view('livewire.test');
    }
}
