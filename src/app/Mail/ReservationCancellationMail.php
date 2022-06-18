<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use App\Models\Course;

class ReservationCancellationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $reservation;
    protected $from_email;
    protected $course;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        Reservation $reservation,
        $from_email,
        Course $course
    ) {
        $this->reservation = $reservation;
        $this->from_email = $from_email;
        $this->course = $course;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from_email)
            ->subject('予約キャンセルのお知らせ')
            ->view('emails.cancel')
            ->with(['reservation' => $this->reservation, 'course' => $this->course]);
    }
}
