<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Mail;

class NotificadorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'notificador';
    }

    public function enviar($usuario, $mensaje)
    {
        // Ejemplo: enviar por correo
        Mail::raw($mensaje, function ($mail) use ($usuario) {
            $mail->to($usuario->email)
                 ->subject('Notificación');
        });
    }
}
