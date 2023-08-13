<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Libro extends Model
{
    use HasFactory;


    public static function create($titulo, $autor, $anio, $genero, $cantidad){

        $libro = new Libro();
        $libro-> titulo = $titulo;
        $libro-> autor = $autor;
        $libro-> anio_publicacion = $anio;
        $libro-> genero = $genero;
        $libro-> disponible = $cantidad;
        $libro-> save();
        return $libro;
    }


    public static function updateBook($id,$titulo, $autor, $anio, $genero, $cantidad){
        $libro = Libro::find($id);
        $libro-> titulo = $titulo;
        $libro-> autor = $autor;
        $libro-> anio_publicacion = $anio;
        $libro-> genero = $genero;
        $libro-> disponible = $cantidad;
        $libro-> save();
        return $libro;
    }


    public static function deleteBook($id){
        $libro = Libro::find($id);
        $libro->delete();
    }

       
        public static function allBook(){
            return Libro::all();
        }
}
