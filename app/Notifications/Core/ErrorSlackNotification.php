<?php

namespace App\Notifications\Core;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class ErrorSlackNotification extends Notification
{
    use Queueable;
    public $sector;
    public $message;
    public $stackTrace;

    /**
     * Create a new notification instance.
     *
     * @param $sector
     * @param $message
     * @param $stackTrace
     */
    public function __construct($sector, $message, $stackTrace)
    {
        //
        $this->sector = $sector;
        $this->message = $message;
        $this->stackTrace = $stackTrace;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the Slack representation of the notification.
     *
     * @param mixed $notifiable
     * @return SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->to('#trainznation')
            ->error()
            ->content($this->message)
            ->content("<strong>Secteur:</strong> " . $this->sector)
            ->content("<strong>Stack:</strong> " . $this->stackTrace);
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
            //
        ];
    }
}
