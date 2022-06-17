<?php

namespace App\Auth\Listeners;

use App\Auth\Events\RepresetativeRegistered;
use App\Contracts\Auth\MustVerifyShopRepresentativeEmail;

class SendShopRepresentativeEmailVerificationNotification
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(RepresetativeRegistered $event)
    {
        if ($event->shop_representative instanceof MustVerifyShopRepresentativeEmail && ! $event->shop_representative->hasVerifiedEmail()) {
            $event->shop_representative->sendEmailVerificationNotification();
        }
    }
}
