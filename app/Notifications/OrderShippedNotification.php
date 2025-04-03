<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Commande;

class OrderShippedNotification extends Notification
{
    use Queueable;

    protected $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Sen Librairie - Votre commande #' . $this->commande->id . ' a été expédiée')
            ->greeting('Cher(e) ' . $this->commande->client->name . ',')
            ->line('Nous sommes heureux de vous informer que votre commande a été expédiée.')
            ->line('Récapitulatif de votre commande:')
            ->line('- Numéro de commande: #' . $this->commande->id)
            ->line('- Date de commande: ' . $this->commande->dateCommande->format('d/m/Y H:i'))
            ->line('- Montant total: ' . number_format($this->commande->montantTotal, 0, ',', ' ') . ' FCFA')
            ->action('Suivre ma commande', route('commandes.mes-commandes'))
            ->line('Nous vous remercions de votre confiance.')
            ->salutation('L\'équipe Sen Librairie');
    }
}
