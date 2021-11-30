<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentRecievedNotification extends Notification
{
    use Queueable;

    protected $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
                    ->subject('New Payment Recieved.')
                    ->greeting('Hi '. $notifiable->first_name)
                    ->line('A new payment recieved for '. env('APP_NAME', 'Weddingbook.lk') .'.')
                    ->line('.')
                    ->line('Name (Vendor): '. $this->data->vendor->first_name.' '.$this->data->vendor->last_name)
                    ->line('Amount: '. $this->data->currency .' '. $this->data->amount)
                    ->line('Reason: '. ucfirst($this->data->description))
                    ->line('Date: '. $this->data->created_at)
                    ->line('.')
                    ->line('Thank you.');
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
