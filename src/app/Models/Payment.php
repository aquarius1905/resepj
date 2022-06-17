<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');

    function reservation()
    {
        return $this->hasOne(Reservation::class);
    }
}
