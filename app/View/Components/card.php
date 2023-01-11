<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{
    public $textcolor;
    public $bordercolor;
    public $bigtext;
    public $smalltext;
   
    public function __construct($textcolor, $bordercolor, $bigtext, $smalltext )
    {
        $this->textcolor = $textcolor;
        $this->bordercolor = $bordercolor;
        $this->bigtext = $bigtext;
        $this->smalltext = $smalltext;
    }
    
   
    public function render()
    { 
        return view('components.card');
    }
}
