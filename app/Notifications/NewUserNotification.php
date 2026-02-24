<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Nouvel utilisateur inscrit')
                    ->line('Bonjour Amadou Camara !')
                    ->line('Un nouvel utilisateur vient de creer un compte sur B-manager')
                    ->line('Nom : ' .$this->user->name)
                    ->line('Email : ' .$this->user->email)
                    ->line('Telephone : ' .$this->user->telephone)
                    //->action('Notification Action', url('/'))
                    ->line('Responsable Informatique');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Nouvel utilisateur : '.$this->user->name, 
            'user_id' => $this->user->id,
        ];
    }
}
