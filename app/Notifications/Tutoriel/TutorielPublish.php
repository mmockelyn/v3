<?php

namespace App\Notifications\Tutoriel;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TutorielPublish extends Notification
{
    use Queueable;
    private $tutoriel;

    /**
     * Create a new notification instance.
     *
     * @param $tutoriel
     */
    public function __construct($tutoriel)
    {
        //
        $this->tutoriel = $tutoriel;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "icon" => "la la-youtube-play",
            "icon_color" => "success",
            "type" => "event",
            "state" => 2,
            "title" => "Le tutoriel <strong>" . $this->tutoriel->title . "</strong> à été publier",
            "text" => "Tutoriel publier",
            "date" => now(),
            "link" => null
        ];
    }
}
