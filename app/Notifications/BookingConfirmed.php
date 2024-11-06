<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Booking;


class BookingConfirmed extends Notification
{
    use Queueable;

    protected $booking;
    /**
     * Create a new notification instance.
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Confirmation de Réservation')
        ->greeting('Bonjour ' . $notifiable->name . ',')
        ->line('Votre réservation a été confirmée.')
        ->line('Détails de la réservation:')
        ->line('Chambre: ' . $this->booking->room->room_number . ' - ' . $this->booking->room->room_type)
        ->line('Date d\'arrivée: ' . $this->booking->check_in_date)
        ->line('Date de départ: ' . $this->booking->check_out_date)
        ->line('Prix total: ' . $this->booking->total_price)
        ->line('Merci d\'avoir choisi notre hôtel!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'booking_id'=>$this->booking->id,
            'room_type'=>$this->booking->room_type,
            'date'=>$this->booking->check_in_date,
            'date'=>$this->booking->check_out_date,
            'price'=>$this->booking->price,
        ];
    }
}



