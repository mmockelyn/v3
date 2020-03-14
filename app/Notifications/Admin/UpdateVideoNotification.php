<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateVideoNotification extends Notification
{
    use Queueable;
    /**
     * @var
     */
    public $arr;
    /**
     * @var
     */
    public $count;

    /**
     * Create a new notification instance.
     *
     * @param $arr
     * @param $count
     */
    public function __construct($arr, $count)
    {
        //
        $this->arr = $arr;
        $this->count = $count;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject("Vidéo mise à jours")
            ->markdown('email.admin.updateVideo', [$this->arr, $this->count]);
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
            //
        ];
    }
}
