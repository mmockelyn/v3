<?php

namespace App\Notifications\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdatePasswordNotification extends Notification
{
    use Queueable;
    /**
     * @var
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        //
        $this->user = $user;
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
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Modification de votre mot de passe")
            ->greeting("Bonjour ".$this->user->name.',')
            ->line("Une mise à jour de votre mot de passe est intervenue ce jour à ".now()->format('H:i'))
            ->line("Si vous n'êtes pas à l'origine de cette modification, n'hésitez pas à nous le signaler à l'adresse trainznation@gmail.com");
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
            "icon" => "fa fa-key",
            "icon_color" => "success",
            "type" => "event",
            "title" => "Modification de votre mot de passe",
            "text" => "La modification de votre mot de passe à été exécuter avec succès",
            "date" => now(),
            "link" => null
        ];
    }
}
