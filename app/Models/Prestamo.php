<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = ['fecha_prestamo', 
                           'libro_id', 
                           'encargado_id', 
                           'lector_id',
                            'estado'];

    public function libro(): BelongsTo{
        return $this->belongsTo(Libro::class);
    }

    public function lector(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function encargado(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    
    public function estado(){
        return $this->estado;
    }

    public function consultarEstado(){
        switch ($this->estado) {
            case '1':
                return 'Préstamo activo.';
            case '2':
                return 'Libro devuelto.';
            case '3':
                return 'Préstamo renovado.';
            case '0':
                return 'Libro extraviado.';
            default:
                return 'Estado desconocido.';
        }        
    }

    public function calcularRetraso($fecha_devolucion_real){
        if ($fecha_devolucion_real>$this->fecha_devolucion_programada)
            return $fecha_devolucion_real->diff($this->fecha_devolucion_programada)->days;
        else
            return 0; 
    }

}
