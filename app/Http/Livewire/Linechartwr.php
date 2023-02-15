<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;



class Linechartwr extends Component
{
    public function render()
    {
        $lineChartModel =
    (new LineChartModel())
        ->setTitle('Expenses by Type')
        ->singleLine()
        ->withDataLabels()
        // ->sparklined()
        // ->setSparklineEnabled(true)
        ->addPoint('add point 1', 10)
        ->addPoint('add point 2', 20)
        ->addPoint('add point 3', 15)
        ->addPoint('add point 4', 35)
        ->addPoint('add point 5', 60)

    ;
        return view('livewire.linechartwr')->extends('layouts.main')->section('content')
        ->with([ 'lineChartModel' => $lineChartModel, ]);
    }
}
