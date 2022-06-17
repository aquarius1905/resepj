<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Routing\Controller;
use App\Responses\VerifyShopRepresentativeEmailResponse;
use Laravel\Fortify\Http\Requests\VerifyEmailRequest;

class VerifyShopRepresetativeEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Laravel\Fortify\Http\Requests\VerifyEmailRequest  $request
     * @return \App\Http\Responses\VerifyShopRepresentativeEmailResponse
     */
    public function __invoke(VerifyEmailRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return app(VerifyShopRepresentativeEmailResponse::class);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return app(VerifyShopRepresentativeEmailResponse::class);
    }
}
