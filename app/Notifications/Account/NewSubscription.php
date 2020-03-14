<?php

namespace App\Notifications\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSubscription extends Notification
{
    use Queueable;
    /**
     * @var
     */
    public $user;
    /**
     * @var
     */
    public $subscription;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $subscription
     */
    public function __construct($user, $subscription)
    {
        //
        $this->user = $user;
        $this->subscription = $subscription;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Souscription à l'offre premium")
            ->greeting("Bonjour ".$this->user->name.',')
            ->line("Vous avez souscrit à notre offre <strong>Premium</strong> et nous vous en remercions")
            ->line("Cette souscription est valable jusqu'au ".$this->subscription->premium_end->format('d/m/Y')." compris.")
            ->line("Cette abonnement est automatiquement renouveller à date anniversaire.<br>
Si vous ne souhaiter plus bénéficier de notre offre, vous pouvez résillier à tous moment par l'intermédiaire de votre espace membre.")
            ->line("Une alerte vous sera envoyer 5 jours avant la fin de votre abonnement.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "icon" => "fa fa-certificate",
            "icon_color" => "warning",
            "type" => "alert",
            "state" => 2,
            "title" => "Premium",
            "text" => "Vous bénéficier désormais de l'offre PREMIUM",
            "date" => now(),
            "link" => null
        ];
    }
}
