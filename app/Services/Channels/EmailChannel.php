<?php
namespace App\Services\Channels;

use App\Contracts\NotificationChannelInterface;
use Illuminate\Support\Facades\Log;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;

class EmailChannel implements NotificationChannelInterface {

    public function enviar(string $message, array $recipient): bool {
        // Implementación real
        try {
            // Validación básica del destinatario
            if (!isset($recipient['email']) || !filter_var($recipient['email'], FILTER_VALIDATE_EMAIL)) {
                throw new \InvalidArgumentException('Email address is invalid or missing');
            }

            Log::debug('Preparando envío de email', [
                'to' => $recipient['email'],
                'message_length' => strlen($message)
            ]);

            // Envío real del email
            Mail::to($recipient['email'])
                ->send(new NotificationEmail(
                    subject: 'Notificación del Sistema',
                    content: $message,
                    metadata: $recipient
                ));

            Log::info('Email enviado exitosamente a: '.$recipient['email']);

            return true;

        } catch (\InvalidArgumentException $e) {
            Log::warning('Error de validación en EmailChannel: '.$e->getMessage());
            return false;
            
        } catch (\Exception $e) {
            Log::error('Error enviando email a '.($recipient['email'] ?? 'unknown').': '.$e->getMessage());
            return false;
        }
    }
}