<?php

namespace App\Http\Controllers;

use App\Models\Prestamos;
use Illuminate\Http\Request;

class PrestamosController extends Controller
{
   public function showAllPrestamos(){
    $prestamos = Prestamos::allPrestamo();
    return view('livewire.prestamos-component');
   }
}
