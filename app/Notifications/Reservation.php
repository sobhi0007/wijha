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
    private $title;
    private $body;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($unit,$user,$title,$body)
    {
            $this->unit = $unit;
            $this->user = $user;
            $this->title = $title;
            $this->body = $body;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
        ->subject($this->title)
        ->greeting(__('lang.greeting').$this->user->name.' !')
        ->line($this->body)
        ->line(__('lang.wish_you_a_good_day'))
      ;
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
           'title' => $this->title,
           'body'=> $this->body,
        ];
    }
}
