<?php
namespace App\Services;
use App\Contracts\Prestable;
use App\Models\Prestamo;
use App\Models\User;
use Exception;
use App\Exceptions\ValidationException;

class prestamoService implements Prestable{

    public function getAllPrestamos(){
        return Prestamo::all();
    }

    public function createPrestamo(array $data){
        $prestamo = Prestamo::create($data);
        return $prestamo;
    }

    public function deletePrestamo(Prestamo $prestamo){
        return $prestamo->delete();
    }

    public function getPrestamoById($id){
        $prestamo = Prestamo::firstWhere('id', $id);
        return $prestamo;
    }

    public function cancelPrestamo(Prestamo $prestamo){
        try{
            $prestamo->libro()->cambiarEstado('1');
            $prestamo->libro()->save();
            $prestamo->estado='4';
            $prestamo->save();    
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function validarLector(User $lector):void{
        if ($lector->tienePrestamosPendientes()){
            throw new ValidationException('El lector tiene préstamos pendientes');
        }

    }
    public function validarLibro($libro):void{
        if (!($libro->estado === '1')){
            throw new ValidationException('Libro no disponible para préstamo');
        } 
    }
}