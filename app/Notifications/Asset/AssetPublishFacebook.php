<?php

namespace App\Notifications\Asset;

use App\Model\Asset\Asset;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

class AssetPublishFacebook extends Notification
{
    use Queueable;
    /**
     * @var Asset
     */
    private $asset;

    /**
     * Create a new notification instance.
     *
     * @param Asset $asset
     */
    public function __construct(Asset $asset)
    {
        //
        $this->asset = $asset;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FacebookPosterChannel::class];
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

    public function toFacebookPoster($notifiable)
    {
        return (new FacebookPosterPost($this->asset->designation))
            ->withLink(route('Front.Download.show', [$this->asset->category->id, $this->asset->subcategory->id, $this->asset->id]));
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
