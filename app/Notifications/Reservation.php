<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Reservation extends Notification
{
    use Queueable;

    private $unit;
    private $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($unit,$user)
    {
      
        
        $this->unit = $unit;
         $this->user = $user;
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
     

        $url = env('APP_URL');
        return (new MailMessage)
        ->subject('Booking Reserved Successfully')
        ->line('Hi Mr ,'.$this->user->name.' , your booking has been reserved successfully for '.$this->unit->title.'.  Thank you for choosing our service.')
        ->action('Notification Action', url('/'))
        ->line('Thank you for using Wijha!');
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