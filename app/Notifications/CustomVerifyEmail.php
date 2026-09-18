<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(
                config('auth.verification.expire', 60)
            ),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return (new MailMessage)
            ->subject('Vérifiez votre adresse e-mail')
            ->line('<img src="{{asset(\'asset/logo/Logo B.Manager.png\')}}" width="100" alt="Logo Bmanager">')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Merci d’avoir créé votre compte sur Bmanager.')
            ->line('Pour finaliser votre inscription et accéder à votre espace, veuillez confirmer votre adresse e-mail.')
            ->action('Vérifier mon adresse e-mail', $verificationUrl)
            ->line('Ce lien de vérification est valable pendant une durée limitée.')
            ->line('Si vous n’êtes pas à l’origine de cette inscription, vous pouvez ignorer cet e-mail.')
            ->salutation('Cordialement,')
            ->salutation('L’équipe BCM Groupe');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [];
    }
}