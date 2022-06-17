<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReminderMail;
use App\Models\Reservation;
use App\Models\Administrator;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReservationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email at 9am on the day of reservation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::today();
        $today = $today->format('Y-m-d');
        $reservations = Reservation::with(['user'])
        ->wheredate('date', $today)
        ->get();
        if($reservations->count() == 0) {
            return;
        }
        $admins = Administrator::all();
        $from_email = $admins[0]->email;

        foreach($reservations as $reservation) {
            //予約当日メールを送信
            Mail::to($reservation->getUserEmail())
            ->send(new ReservationReminderMail($reservation, $from_email));
        }
    }
}
