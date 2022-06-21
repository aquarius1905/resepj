<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function representative()
    {
        return $this->belongsTo(ShopRepresentative::class);
    }

    public function getAreaName()
    {
        return optional($this->area)->name;
    }

    public function getGenreName()
    {
        return optional($this->genre)->name;
    }

    public function isLike()
    {
        return !optional($this->likes)->isEmpty();
    }

    public function getLikeId()
    {
        return optional($this->likes)->first()->id;
    }

    public function scopeWhereArea($query, $area_id)
    {
        if ($area_id && $area_id > 0) {
            return $query->where('area_id', $area_id);
        }
    }

    public function scopeWhereGenre($query, $genre_id)
    {
        if ($genre_id && $genre_id > 0) {
            return $query->where('genre_id', $genre_id);
        }
    }

    public function scopeWhereShopName($query, $shop_name)
    {
        if ($shop_name) {
            return $query->where('name', 'like', "%{$shop_name}%");
        }
    }
}
