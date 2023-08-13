<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Navigation extends Component
{
    public function render()
    {
        $menus = [
            (object)["name" => 'Libros', "route_name" => 'libros'],
            (object)["name" => 'Prestamos', "route_name" => 'prestamos'],
            (object)["name" => 'Usuarios', "route_name" => 'users'],
        ]; 
        return view('livewire.navigation',compact('menus'));
    }
}
