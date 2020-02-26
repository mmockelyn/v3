<?php

namespace App\Notifications\Tutoriel;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostNewCommentOtherTutoriel extends Notification
{
    use Queueable;
    /**
     * @var
     */
    private $blog;

    /**
     * Create a new notification instance.
     *
     * @param $blog
     */
    public function __construct($blog)
    {
        //
        $this->blog = $blog;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            "icon" => "fa fa-comment",
            "icon_color" => "success",
            "type" => "alert",
            "state" => 2,
            "title" => "Un nouveau commentaire à été poster.",
            "text" => "Un nouveau commentaire à été poster sur le tutoriel:<br> <strong>".$this->blog->title."</strong>",
            "date" => now(),
            "link" => route('Front.Tutoriel.show', $this->blog->slug)
        ];
    }
}
