<?php
namespace App\Contracts;
use App\Models\User;
use App\Models\Libro;

interface Prestable{
    public function validarLector(User $lector):void; //Que el lector no tenga préstamos pendientes
    public function validarLibro(Libro $libro):void; //QUe el libro esté disponible para su préstamo
}