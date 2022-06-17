<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Reservation;
use App\Models\Rating;

class RatingController extends Controller
{
    public function show($reservation_id)
    {
        $reservation = Reservation::find($reservation_id);

        return view('rating', ['reservation' => $reservation]);
    }

    public function store(RatingRequest $request)
    {
        $inputs = $request->except(['_token']);
        Rating::create($inputs);

        return view("rating_done");
    }
}
