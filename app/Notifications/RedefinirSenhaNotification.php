<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;

    public $token;
    public $email;
    public $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
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
        $url = config('app.url') . "/password/reset/" . $this->token . '?email=' . $this->email;
        $minutos = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        
        return (new MailMessage)
            ->subject(Lang::get('Notificação de redefinição da senha.'))
            ->greeting('Olá '. $this->name. ',')
            ->line(Lang::get('Você recebeu esse email pois solicitou a redefinição de senha.'))
            ->line(Lang::get('Esse link para redefinir a senha se expirará em '. $minutos .' minutos.'))
            ->line(Lang::get('Se você não solicitou uma redefinição de senha, nenhuma outra ação será necessária.'))
            ->action(Lang::get('Redefinir Senha'), $url)
            ->salutation('Até breve!');
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
