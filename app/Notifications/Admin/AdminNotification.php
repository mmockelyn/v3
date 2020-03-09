<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotification extends Notification
{
    use Queueable;
    public $icon;
    public $type;
    public $state;
    public $title;

    /**
     * Create a new notification instance.
     *
     * @param $icon
     * @param $type
     * @param $state
     * @param $title
     */
    public function __construct($icon, $type, $state, $title)
    {
        //
        $this->icon = $icon;
        $this->type = $type;
        $this->state = $state;
        $this->title = $title;
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
            "icon" => $this->icon,
            "icon_color" => $this->type,
            "type" => "log",
            "state" => $this->state,
            "title" => $this->title,
            "text" => $this->title,
            "date" => now(),
            "link" => null
        ];
    }
}
