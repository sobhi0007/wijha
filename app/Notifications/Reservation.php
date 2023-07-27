<?php

namespace App\Notifications;

use App\Enums\BookingStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class Reservation extends Notification
{
    use Queueable;

    private $booking;
    private $user;
    private $title;
    private $body;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($booking,$user,$title,$body)
    {
            $this->booking = $booking;
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
        $mail = (new MailMessage)
            ->subject($this->title)
            ->greeting(__('lang.greeting').$this->user->name.' !')
            ->line($this->body);
    
        if ($this->booking->status->value === BookingStatus::APPROVED->value) {
             $mail->action(__('lang.see_booking_unit_info'), route('user.reservations.details',['booking'=>$this->booking->id]));
        }

        return $mail->line(__('lang.wish_you_a_good_day'));
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
