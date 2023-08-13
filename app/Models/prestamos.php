<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamos extends Model
{
    use HasFactory;

    public static function create($user_id,$book_id,$fecha_prestamo,$fecha_devolucion,$devuelto){

        $prestamo=new Prestamos();
        $prestamo->user_id=$user_id;
        $prestamo->book_id=$book_id;
        $prestamo->fecha_prestamo=$fecha_prestamo;
        $prestamo->fecha_devolucion=$fecha_devolucion;
        $prestamo->devuelto=$devuelto;
        $prestamo->save();

        return $prestamo;
    }


    public static function allPrestamo(){
        return Prestamos::all();
    }
}
