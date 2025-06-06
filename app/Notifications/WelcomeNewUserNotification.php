<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Password;

class WelcomeNewUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct() {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $token = Password::createToken($notifiable);

        $resetUrl = url(route('filament.admin.auth.password-reset.request', [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('¡Bienvenido a '.config('app.name').'!')
            ->greeting('¡Hola '.$notifiable->name.'!')
            ->line('¡Te damos la bienvenida a '.config('app.name').'!')
            ->line('Se ha creado una cuenta para ti con una contraseña temporal.')
            ->line('Para tu seguridad, es necesario que cambies tu contraseña antes de ingresar al sistema.')
            ->action('Cambiar contraseña', $resetUrl)
            ->line('Si no solicitaste esta cuenta, no es necesario realizar ninguna acción.')
            ->salutation('¡Saludos del equipo de '.config('app.name').'!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
