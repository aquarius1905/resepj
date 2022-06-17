<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;
use App\Mail\ReservationCompletionMail;
use App\Models\Reservation;
use App\Models\Administrator;
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
        $course = Course::find($reservation->course_id);
        $admins = Administrator::all();
        $from_email = $admins[0]->email;
        $to_email = Auth::user()->email;
        Mail::to($to_email)->send(
            new ReservationCompletionMail($reservation, $from_email, $course, false)
        );
        return view("done");
    }

    public function destroy($id)
    {
        Reservation::find($id)->delete();
        Payment::where('reservation_id', $id)->delete();

        return back();
    }

    public function update(ReservationRequest $request, $id)
    {
        $inputs = $request->except(['_token']);
        Reservation::where('id', $id)->update($inputs);

        //予約変更メール送信
        $reservation = Reservation::find($id);
        $course = Course::find($reservation->course_id);
        $admins = Administrator::all();
        $from_email = $admins[0]->email;
        $to_email = Auth::user()->email;
        Mail::to($to_email)->send(
            new ReservationCompletionMail($reservation, $from_email, $course, true)
        );

        return view('change_done');
    }

    public function updateRatingFlg($id)
    {
        Reservation::where('id', $id)->update(['rating_flg' => true]);

        return view('read_qr_done');
    }
}
