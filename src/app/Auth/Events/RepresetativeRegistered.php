<?php

namespace App\Auth\Events;

use Illuminate\Queue\SerializesModels;

class RepresetativeRegistered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $shop_representative;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct($shop_representative)
    {
        $this->shop_representative = $shop_representative;
    }
}
