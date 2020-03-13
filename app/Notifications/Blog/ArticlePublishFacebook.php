<?php

namespace App\Notifications\Blog;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class ArticlePublishFacebook extends Notification
{
    use Queueable;
    /**
     * @var
     */
    public $blog;

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
        return [FacebookPosterChannel::class];
    }

    /**
     * Get the Facebook post representation of the notification.
     *
     * @param mixed $notifiable .
     * @return FacebookPosterPost
     */
    public function toFacebookPoster($notifiable) {
        return (new FacebookPosterPost($this->blog->title))
            ->withLink(route('Front.Download.show', [$this->asset->category->id, $this->asset->subcategory->id, $this->asset->id]));
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
