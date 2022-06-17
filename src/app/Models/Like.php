<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function getShopId()
    {
        return optional($this->shop)->id;
    }

    public function getShopName()
    {
        return optional($this->shop)->name;
    }

    public function getShopAreaName()
    {
        return optional($this->shop)->getAreaName();
    }

    public function getShopGenreName()
    {
        return optional($this->shop)->getGenreName();
    }

    public function getShopImgFileName()
    {
        return optional($this->shop)->img_filename;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
