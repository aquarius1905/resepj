<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;
use App\Models\Course;

class ReservationCompletionMail extends Mailable
{
    use Queueable, SerializesModels;


    protected $reservation;
    protected $from_email;
    protected $course;
    protected $change_flg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        Reservation $reservation,
        $from_email,
        Course $course,
        $change_flg
    ) {
        $this->reservation = $reservation;
        $this->from_email = $from_email;
        $this->course = $course;
        $this->change_flg = $change_flg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->change_flg ? '予約変更完了のお知らせ' : '予約完了のお知らせ';
        return $this->from($this->from_email)
            ->subject($subject)
            ->view('emails.reservation')
            ->with([
                'reservation' => $this->reservation,
                'course' => $this->course,
                'cancel_flg' => $this->change_flg
            ]);
    }
}
