<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Libro;

class LibrosController extends Controller

{
    public $title="prueba";
  
    public function addLibro(Request $request){
        $this->title="Add New Book";
       return view('/book-dialog')->with('title', $this->title);
    }

    public function showAllBook(){
        $libros = Libro::allBook();
        return view('livewire.libros-component')->with('libros', $libros);
    }

 
}
