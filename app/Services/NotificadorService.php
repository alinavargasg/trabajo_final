<?php

namespace App\Services;
use App\Contracts\NotificationChannelInterface;

class NotificadorService{
    protected $channels=[];

    public function addChannel(string $name, NotificationChannelInterface $channel): void {
        $this->channels[$name] = $channel;
    }
    
    public function send(string $channelName, string $message, array $recipient): bool {
        if (!isset($this->channels[$channelName])) {
            throw new \InvalidArgumentException("Canal $channelName no registrado");
        }
        
        $channel = $this->channels[$channelName];
        
        if (!$channel instanceof NotificationChannelInterface) {
            throw new \RuntimeException("El canal $channelName no implementa la interfaz NotificationChannelInterface");
        }
        
        return $channel->enviar($message, $recipient);
    }

    
    public function broadcast(array $channels, string $message, array $recipients): array {
        $results = [];
        foreach ($channels as $channel) {
            $results[$channel] = $this->send($channel, $message, $recipients);
        }
        return $results;
    }
}