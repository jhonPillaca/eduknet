<?php

namespace App\Http\Livewire;


use App\Models\Libro;
use App\Models\User;
use Livewire\Component;
use App\Models\Prestamos;

class PrestamosComponent extends Component
{


    public $fechaPermitida;
    public $title="Generar nuevo Prestamo";
    public $modalActive = false;
    public $input_search="";
    public $headers = ['Id', 'Libro', 'Usuario', 'Fecha Prestamo', 'Fecha Devolución', 'Acción'];

    public $data=[];
    public $prestamos;
    public $selectBook;
    public $book;
    public $user;
    public $fechDev;
    public $devuelto=false;
    public $books=[];
    public $users=[];
    public $listBook=[];
    public $fechaInValida = true;
    public $messageError;

    // public function __construct(){
    //     $this->books = Libro::allBook();
    //     $this->users = User::allUser();
    // }

    protected $listeners=['render','finPress'];


    public function mount(){
        $this->prestamos = Prestamos::allPrestamo();

        $this->books = Libro::allBook();
        $this->users = User::allUser();
        $this->listPrestms($this->prestamos);
        $this->fechaPermitida = now()->addDay()->toDateString();
        $this->fechDev=$this->fechaPermitida;
        $this->validFecha();

    }



public function validFecha()
{
    if ($this->fechDev < $this->fechaPermitida) {
        $this->fechaInValida = true;
        $this->messageError="La fecha mínimo es un día apartir de hoy";
    } else {
        $this->fechaInValida = false;

    }
}

    public function savePrestm(){
        
        $newPrestamo= Prestamos::create($this->users[0]->id,$this->book,now()->toDateString(),$this->fechDev,$this->devuelto);
        $this->prestamos[] = $newPrestamo;

        $this->modalActive = false;
        $this->listPrestms($this->prestamos);

        $this->book="";
        $this->fechDev="";
        $this->devuelto=false;
    }


    public function listPrestms($prestms){
        
        $this->data = $prestms->map(function ($prestamo) {
            $libro = $this->getData($prestamo->book_id, $this->books);
            $usuario = $this->getData($prestamo->user_id, $this->users);
            
            return [
                $prestamo->id,
                $libro?->titulo,
                $usuario?->name,
                $prestamo->fecha_prestamo,
                $prestamo->fecha_devolucion,
            ];
        })->toArray();
    }


    public function getData($id, $dato)
    {
        foreach ($dato as $item) {
            if ($item->id === $id) {
                
                return $item;
            }
        }
    
        return null;
    }


    public function render()
    {
        return view('livewire.prestamos-component');
    }
}
