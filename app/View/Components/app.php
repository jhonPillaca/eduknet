<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class app extends Component
{
    public $componente;
    public function __construct($component)
    {
       $this->componente = $component;
       
    }


    public function render(): View|Closure|string
    {
        
        return view('components.app');
    }
}
