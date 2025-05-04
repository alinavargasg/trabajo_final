<?php
namespace App\Services;
use App\Models\Autor;

class AutorService{
    public function getAllAutores(){
        return Autor::all();
    }

    public function getAutorById($id){
        $autor = Autor::firstWhere('id', $id);
        return $autor;
    }

    public function createAutor(array $data){
        $autor = Autor::create($data);
        return $autor;
    }

    public function updateAutor(Autor $autor, array $data){
        $autor->update($data);
        return $autor;
    }

    public function deleteAutor(Autor $autor){
        return $autor->delete();
    }
}