<?php
namespace App\Services\Channels;

use App\Contracts\NotificationChannelInterface;

class smsChannel implements NotificationChannelInterface{
    public function enviar(string $message, array $recipient): bool {
        return true;
    }   
}