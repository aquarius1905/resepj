<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ReservationReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $reservation;
    protected $from_email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation, $from_email)
    {
        $this->reservation = $reservation;
        $this->from_email = $from_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from_email)
            ->subject('ご予約日当日のお知らせ')
            ->view('emails.reminder')
            ->with(['reservation' => $this->reservation]);
    }
}
