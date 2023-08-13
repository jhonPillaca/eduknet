<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class DataSource extends Component
{



    public $headers;
    public $datos;
    public $input_search="";

    public $componete;
    public $books;

    public function __construct($headers, $data)
    {
        $this->headers = $headers;
        $this->datos = $data;
     $this->books =  Cache::put('libros', $data, now()->addMinutes(60));

    }

    public function render()
    {
        // dd($this->data);
        
        return view('components.data-source');
    }

}