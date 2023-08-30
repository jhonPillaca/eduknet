   <?php

use App\Http\Controllers\PrestamosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrosController;



Route::get('/', function () {
    if (auth()->check()) {
        return view('libros');
    } else {
        return view('welcome');
    }
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/libros', function () {
        return view('components.app', ['component' => 'livewire.libros-component']);
    })->name('libros');
    
    Route::get('/prestamos', function () {
        return view('components.app', ['component' => 'livewire.prestamos-component']);
    })->name('prestamos');
    
    Route::get('/users', function () {
        return view('components.app', ['component' => 'livewire.user-component']);
    })->name('users');
});


