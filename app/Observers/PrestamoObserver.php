<?php
namespace App\Observers;
use app\Models\prestamo;
use App\Services\LoggerSingleton;

Class PrestamoObserver{
    private $logger;
    public function __construct(LoggerSingleton $logger){
        $this->logger = $logger;
    }


    public function creating(Prestamo $prestamo)
    {
        $this->logger->log("Se está registrando un nuevo préstamo");
    }

    public function created(Prestamo $prestamo)
    {
        $prestamo->libro->cambiarEstado($prestamo->estado);
    }
   
    public function updating(Prestamo $prestamo)
    {
        if ($prestamo->isDirty('estado')){
            $oldStatus = $prestamo->getOriginal('estado');
            $newStatus = $prestamo->estado();
            $this->logger->log("Estado del préstamo cambiado de {$oldStatus} a {$newStatus}");
        }

    }

    public function updated(Prestamo $prestamo){
        if ($prestamo->isDirty('estado')){
            $prestamo->libro->cambiarEstado($prestamo->estado);
        }
    }

    public function deleting(Prestamo $prestamo){
        $this->logger->log("Se está eliminando el préstamo nro: {{$prestamo->id}}");
    }

    public function deleted(Prestamo $prestamo){
        $prestamo->libro->cambiarEstado('1');
    }
}