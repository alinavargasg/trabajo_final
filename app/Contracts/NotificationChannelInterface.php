<?php
namespace App\Contracts;
interface NotificationChannelInterface{
    public function enviar(string $mensaje, array $recipiente):bool;
}
