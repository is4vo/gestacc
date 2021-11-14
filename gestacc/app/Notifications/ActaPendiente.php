<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ActaPendiente extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($acta)
    {
        $this->acta = $acta; 
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
        $acta = $this->acta;
        return (new MailMessage)
                    ->greeting('Hola,')
                    ->line('Tiene un acta pendiente por aprobar')
                    ->line('Acta: Reunión '.$acta->tipo_reunion.'-'.$acta->numero_reunion)
                    ->line('Fecha: '.date('d-m-Y', strtotime($acta->fecha_reunion)))
                    ->action('Ver más', url('/'));
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
