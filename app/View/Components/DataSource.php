<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class DataSource extends Component
{


    public $actionEdit=false;
    public $fin_pres=false;

    public $headers;
    public $datos;
    public $input_search="";

    public $componete;
    public $books;
    public $estado=false;
    public $user_logueado =false;
    public $message = "No tienes permiso para hacer esta acción";


    public function __construct($headers, $data,$actionEdit,$prest,$estado)
    {
        $this->headers = $headers;
        $this->datos = $data;
        $this->actionEdit = $actionEdit;
        $this->fin_pres=$prest;
        $this->estado=$estado;
        $userId =  Auth::user();
        $this->user_logueado =  $userId->id ==1;


     $this->books =  Cache::put('libros', $data, now()->addMinutes(60));

    }

    public function render()
    {
        // dd($this->data);
        
        return view('components.data-source');
    }

}