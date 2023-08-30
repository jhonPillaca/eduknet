<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navigation extends Component
{
    public $user_logueado=false;
    public function render()
    {
        $userId =  Auth::user();
        $this->user_logueado =  $userId->id ==1;
        $menus = [
            (object)["name" => 'Libros', "route_name" => 'libros'],
            (object)["name" => 'Prestamos', "route_name" => 'prestamos'],
            (object)["name" => 'Usuarios', "route_name" => 'users'],
        ]; 
        return view('livewire.navigation',compact('menus'));
    }
}
