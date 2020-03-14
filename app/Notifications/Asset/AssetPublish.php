<?php

namespace App\Notifications\Asset;

use App\Model\Asset\Asset;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssetPublish extends Notification
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
            "icon" => "fa fa-cubes",
            "icon_color" => "success",
            "type" => "event",
            "state" => 2,
            "title" => "Objet: <strong>" . $this->asset->designation . "</strong>",
            "text" => "Objet publier",
            "date" => now(),
            "link" => route('Front.Download.show', [$this->asset->category->id, $this->asset->subcategory->id, $this->asset->id])
        ];
    }
}
