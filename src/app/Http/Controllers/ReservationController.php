<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use App\Mail\ReservationCompletionMail;
use App\Mail\ReservationCancellationMail;
use App\Models\Reservation;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function store(ReservationRequest $request)
    {
        $inputs = $request->except(['_token', 'payment_id']);
        $inputs['user_id'] = Auth::id();
        $inputs['rating_flg'] = false;
        $reservation = Reservation::create($inputs);

        //paymentsテーブルにreservation_idを登録
        Payment::where('id', $request->payment_id)
            ->update(['reservation_id' => $reservation->id]);

        //予約完了メールを送信
        $this->sendMail($reservation, false, false);

        return view('done', [
            'status' => 'reserve'
        ]);
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();
        Payment::where('reservation_id', $id)->delete();

        //予約キャンセルメールを送信
        $this->sendMail($reservation, false, true);

        return view('done', [
            'status' => 'cancel'
        ]);
    }

    public function update(ReservationRequest $request, $id)
    {
        $inputs = $request->except(['_token']);
        Reservation::where('id', $id)->update($inputs);

        //予約変更メール送信
        $reservation = Reservation::find($id);
        $this->sendMail($reservation, true, false);

        return view('done', [
            'status' => 'change'
        ]);
    }

    public function updateRatingFlg($id)
    {
        Reservation::where('id', $id)->update(['rating_flg' => true]);

        return view('read_qr_done');
    }

    private function sendMail($reservation, $change_flg, $cancel_flg)
    {
        $course = Course::find($reservation->course_id);
        $from_email = config('mail.from.address');
        $to_email = Auth::user()->email;

        if ($cancel_flg) {
            Mail::to($to_email)->send(
                new ReservationCancellationMail($reservation, $from_email, $course)
            );
            return;
        }

        Mail::to($to_email)->send(
            new ReservationCompletionMail($reservation, $from_email, $course, $change_flg)
        );
    }
}
