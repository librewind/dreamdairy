<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (App::isLocale('ru')) {
            return (new MailMessage)
                ->subject('Сброс пароля')
                ->greeting('Здравствуйте!')
                ->line('Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи.')
                ->action('Сбросить пароль', route('password.reset', $this->token))
                ->line('Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.')
                ->salutation('С уважением, ' . config('app.name'));
        }

        return (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', route('password.reset', $this->token))
            ->line('If you did not request a password reset, no further action is required.');
    }
}
