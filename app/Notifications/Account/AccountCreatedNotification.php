<?php

namespace App\Notifications\Account;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountCreatedNotification extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    private $user;
    /**
     * @var null
     */
    private $password;

    /**
     * Create a new notification instance.
     *
     * @param User $user
     * @param null $password
     */
    public function __construct(User $user, $password = null)
    {
        $this->user = $user;
        $this->password = $password;
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
        if ($this->password == null) {
            return (new MailMessage)
                ->subject("Bienvenue sur le site Trainznation !")
                ->view("email.account.createdAccount", ["user" => $this->user]);
        } else {
            return (new MailMessage)
                ->subject("Bienvenue sur le site Trainznation !")
                ->view("email.account.createdAccount", ["user" => $this->user, "password" => $this->password]);
        }
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
