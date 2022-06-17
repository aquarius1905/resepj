<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $dates = [ 'date', 'time' ];

    public function getShopId()
    {
        return optional($this->shop)->id;
    }

    public function getShopName()
    {
        return optional($this->shop)->name;
    }

    public function getUserName()
    {
        return optional($this->user)->name;
    }

    public function getUserEmail()
    {
        return optional($this->user)->email;
    }

    public function getCourseId()
    {
        return optional($this->course)->id;
    }

    public function getCourseName()
    {
        return optional($this->course)->name;
    }

    public function getCoursePrice()
    {
        return optional($this->course)->price;
    }

    public function getPrice()
    {
        return optional($this->course)->price * $this->number;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
