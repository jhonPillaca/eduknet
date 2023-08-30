<?php

namespace App\Http\Livewire;


use App\Models\Libro;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Prestamos;
use Illuminate\Http\Request;


class PrestamosComponent extends Component
{


    public $fechaPermitida;
    public $title = "Generar nuevo Prestamo";
    public $modalActive = false;
    public $input_search = "";
    public $headers = ['Id', 'Libro', 'Usuario', 'Fecha Prestamo', 'Fecha Devolución', 'Devuelto', 'Acción'];

    public $data = [];
    public $fin_pres = false;
    public $prestamos;
    public $selectBook;
    public $book;
    public $user;
    public $fechDev;
    public $devuelto = false;
    public $books = [];
    public $users = [];
    public $listBook = [];
    public $fechaInValida = true;
    public $messageError;
    public $selectedBook;
    public $prestId;
    public $user_logueado;

    protected $listeners = ['render', 'confirmDeletPrest' => 'deletPrest', 'bookSelected'];

    public function mount()
    {
        $this->user_logueado = Auth::user();
        $user = $this->user_logueado;
        $this->prestamos = Prestamos::allPrestamo()->filter(function ($prestamo) use ($user) {
            return $prestamo->user_id === $user->id;
        });

        $allBooks = Libro::allBook();
        $this->books = collect($allBooks)->filter(function ($books) {
            return intval($books['disponible']) >= 1;
        });
        $this->listBook = $allBooks;
        $this->users = User::allUser();
        $this->listPrestms($this->prestamos);
        $this->fechaPermitida = now()->addDay()->toDateString();
        $this->fechDev = $this->fechaPermitida;
        $this->validFecha();

    }


    public function bookSelected()
    {
        $this->selectedBook = Libro::find($this->book);

    }


    public function validFecha()
    {
        if ($this->fechDev < $this->fechaPermitida) {
            $this->fechaInValida = true;
            $this->messageError = "La fecha mínimo es un día apartir de hoy";
        } else {
            $this->fechaInValida = false;

        }
    }

    public function savePrestm()
    {

        if (auth()->check()) {
            $newPrestamo = Prestamos::create($this->user_logueado->id, $this->book, now()->toDateString(), $this->fechDev, $this->devuelto);
            $this->updateBook($this->selectedBook);
            $this->prestamos[] = $newPrestamo;

            $this->modalActive = false;
            $this->listPrestms($this->prestamos);

            $this->book = "";
            $this->fechDev = now()->toDateString();
            $this->devuelto = false;
        }
    }


    public function listPrestms($prestms)
    {

        $this->data = $prestms->map(function ($prestamo) {

            $libro = $this->getData($prestamo->book_id, $this->listBook);

            $estado = $prestamo->devuelto ? 'SI' : 'NO';
            return [
                $prestamo->id,
                $libro?->titulo,
                $this->user_logueado?->name,
                $prestamo->fecha_prestamo,
                $prestamo->fecha_devolucion,
                $estado,
            ];

        })->toArray();


    }


    public function getData($id, $dato)
    {

        foreach ($dato as $item) {
            if ($item['id'] === $id) {

                return $item;
            }
        }

        return null;
    }


    public function updateBook($book)
    {
        $cantidad = 0;

        $this->fin_pres ? $cantidad = intval($book['disponible']) + 1 : $cantidad = intval($book['disponible']) - 1;
        Libro::updateBook($book->id, $book->titulo, $book->autor, $book->anio_publicacion, $book->genero, $cantidad);

    }

    public function updatePrest($id)
    {
        $this->prestId = $id;
        $prestamo = Prestamos::find($id);
        $book = Libro::find($prestamo['book_id']);
        $this->fin_pres = $prestamo['devuelto'] == 1 ? false : true;

        $this->updateBook($book);
        $estado = $this->fin_pres ? 1 : 0;
        $updatePrestamo = Prestamos::updatePrestamo($this->prestId, $prestamo->user_id, $prestamo->book_id, $prestamo->fecha_prestamo, $prestamo->fecha_devolucion, $estado);
        $this->prestamos = $this->prestamos->map(function ($prest) use ($updatePrestamo) {
            return $prest->id === $this->prestId ? $updatePrestamo : $prest;
        });
        $this->mount();
    }

    public function deletPrest($idPrest)
    {
        if (auth()->check()) {


            $removePrest = $idPrest;
            $newListPrest = $this->prestamos->filter(function ($elemento) use ($removePrest) {
                return $elemento['id'] !== $removePrest;
            });

            $this->listPrestms($newListPrest);

        }


    }

    public function render()
    {
        return view('livewire.prestamos-component');
    }
}