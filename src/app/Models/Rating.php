<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function getUserName()
    {
        return optional($this->reservation)->getUserName();
    }
    
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
