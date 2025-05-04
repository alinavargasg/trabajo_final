<?php

namespace App\Models;
use App\Models\User;
use App\Contracts\Prestable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Libro extends Model implements Prestable{
    use HasFactory;

    protected $fillable = ['titulo', 
                           'codigo', 
                           'autor_id'];

    public function prestamos(){
        return $this->hasMany(Prestamo::class);
    }

    public function autor(): BelongsTo{
        return $this->belongsTo(Autor::class);
    }

    public function validarLector(User $lector): void{       
        if ($lector->tienePrestamosPendientes()){
            throw new ValidationException("El lector tiene préstamos pendientes.");
        };
    }
    
    public function validarLibro($libro): void{
        if (!($libro->estado === '1')){
            throw new ValidationException("El libro no está disponible.");
        };
    }

    //Cambia el estado el libro según el último cambio de estado del préstamo.
    public function cambiarEstado($estadoActualPrestamo){

        if ($estadoActualPrestamo === '2'){//Préstamo devuelto
            $this->estado = '1'; //Libro disponible
        }
        elseif ($estadoActualPrestamo === '0'){ //Libro extraviado en préstamo
            $this->estado = '0'; //Libro no disponible
        }
        else{
            $this->estado = '2';  //Libro prestado
        }
        $this->save();
    }

    public function estado(){
        switch ($this->estado) {
            case '1':
                return 'Disponible.';
            case '2':
                return 'Prestado.';
            case '0':
                return 'No disponible.';
            default:
                return 'Estado desconocido.';
        }        
    }

}
