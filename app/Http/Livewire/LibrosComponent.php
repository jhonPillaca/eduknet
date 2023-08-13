<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Cache;
use Livewire\Component;

use App\Models\Libro;


class LibrosComponent extends Component
{

    public $title;
    public $component = 'libros-component';
    public $modalOpen = false;
    public $headers = ['Id', 'Titulo', 'Autor', 'Año Publicación', 'Género', 'Disponible', 'Acción'];
    public $data = [];
    public $libros = [];
    public $titulo;
    public $autor;
    public $anio;
    public $genero;
    public $cantidad;
    public $editBookActive = false;
    public $bookId;
    public $input_search="";

    protected $listeners=['render','deletBookId'];
    public function mount()
    {
    
         $this->libros = Libro::allBook();
       
        $this->listBooks($this->libros);
       
    }

    public function saveBook()
    {

        if ($this->editBookActive) {
            $updateBook = Libro::updateBook($this->bookId, $this->titulo, $this->autor, $this->anio, $this->genero, $this->cantidad);
            $this->libros = $this->libros->map(function ($libro) use ($updateBook) {
                return $libro->id === $this->bookId ? $updateBook : $libro;
            });
        } else {
            $newBook = Libro::create($this->titulo, $this->autor, $this->anio, $this->genero, $this->cantidad);
            $this->libros[] = $newBook;
        }
        // Cache::forget('clave');
        $this->modalOpen = false;

        $this->listBooks($this->libros);

        $this->titulo = "";
        $this->autor = "";
        $this->anio = "";
        $this->genero = "";
        $this->cantidad = "";

    }

    public function editBook($book)
    {
        $this->editBookActive = true;
        $this->bookId = $book[0];
        $this->titulo = $book[1];
        $this->autor = $book[2];
        $this->anio = $book[3];
        $this->genero = $book[4];
        $this->cantidad = $book[5];

        $this->modalOpen = true;
    }

    public function deletBookId($book){
        // dd($this->data);
        $removeBook = $book;
        Libro::deleteBook($book);
        $newListBook = $this->libros->filter(function ($elemento) use ($removeBook) {
            return $elemento['id'] !== $removeBook;
        });

        $this->listBooks($newListBook);
    }

    public function listBooks($books){
        $this->data = $books->map(function ($libro) {
            return [
                $libro->id,
                $libro->titulo,
                $libro->autor,
                $libro->anio_publicacion,
                $libro->genero,
                $libro->disponible,
            ];
        })->toArray();
        Cache::put('libros', $this->data, now()->addMinutes(60));

    }

    public function filterBooks(){
        if(!empty($this->input_search)){
           
               $filterData = Libro::where('titulo', 'like', '%' . $this->input_search . '%')->get();
               $this->listBooks($filterData);
           }else{
            $this->listBooks($this->libros);
           }
    }

    public function render()
    {
        if ($this->editBookActive) {
            $this->title = "Editando el libro N°-" . $this->bookId;

        } else {
            $this->title = "Agregar nuevo Libro";
        }

        return view('livewire.libros-component');
    }
}