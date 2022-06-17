<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
