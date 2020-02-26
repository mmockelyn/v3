<?php

namespace App\Notifications\Account;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateInfoNotification extends Notification
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
            ->subject("Modification de vos informations de compte")
            ->greeting("Bonjour ".$this->user->name.',')
            ->line("La mise à jours de vos informations à bien été exécuter ce jours à ".now()->format('H:i'))
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
            "icon" => "flaticon-user-settings",
            "icon_color" => "success",
            "type" => "event",
            "state" => 2,
            "title" => "Modification des informations",
            "text" => "Vos modification ont été exécuter avec succès",
            "date" => now(),
            "link" => null
        ];
    }
}
