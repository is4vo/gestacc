<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaReunion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reunion)
    {
        $this->reunion = $reunion; 
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
        $reunion = $this->reunion;
        return (new MailMessage)
                    ->greeting('Hola,')
                    ->line('Se ha agendado una nueva reunión con la siguiente información:')
                    ->line('Tipo de reunión: '.$reunion->tipo_reunion)
                    ->line('Numero de reunión: '.$reunion->numero_reunion)
                    ->line('Fecha: '.$reunion->fecha_reunion)
                    ->line('Hora de inicio: '.$reunion->hora_inicio)
                    ->line('Hora de término: '.$reunion->hora_termino);
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
