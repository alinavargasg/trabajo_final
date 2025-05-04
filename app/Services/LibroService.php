<?php
namespace App\Services;
use App\Models\Libro;

class LibroService{
    public function getAllLibros(){
        return Libro::all();
    }

    public function createLibro(array $data){
        $libro = Libro::create($data);
        return $libro;
    }

    public function updateLibro(Libro $libro, array $data){
        $libro->update($data);
        return $libro;
    }

    public function deleteLibro(Libro $libro){
        return $libro->delete();
    }
}