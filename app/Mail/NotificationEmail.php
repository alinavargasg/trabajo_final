<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $subject,
        public string $content,
        public array $metadata = []
    ) {}

    public function build()
    {
        return $this
            ->from(config('alinavargasg@yahoo.com'), config('Alina Vargas'))
            ->subject($this->subject)
            ->view('emails.notification', [
                'content' => $this->content,
                'metadata' => $this->metadata
            ]);
    }
}