<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ExportReady extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $filename;

    public function __construct($filename)
    {
       $this->filename = $filename;
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
        return (new MailMessage)
            ->from('noreply@bayport.co.mz','File upload')
            ->replyTo('noreply@bayport.co.mz', 'Bayport Moz')
            ->subject('Export '.$this->filename.' Status')
            ->greeting('Olá')
            ->line('O seu ficheiro '.$this->filename.', foi gerado com sucesso.')
            ->action('Obter ficheiro',route('file/download',$this->filename))
            ->line('Se voçe não gerou nenhum ficheiro recentimente, nenhuma ação é necessaria.')

            ->markdown('vendor.notifications.email');
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
