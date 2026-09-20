<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Domain\Intervention\Models\DemandeTravaux;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeTravauxAcceptee extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly DemandeTravaux $demande) {}

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre demande de travaux a été acceptée')
            ->line("Votre demande « {$this->demande->titre} » a été acceptée.")
            ->action('Voir mes demandes', route('locataire.travaux.index'));
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'demande_id' => $this->demande->id,
            'titre' => $this->demande->titre,
        ];
    }
}
