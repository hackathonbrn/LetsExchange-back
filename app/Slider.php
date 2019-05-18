<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Slider extends Model
{
    public static function allSliders()
    {
        return static::all(); 
    }
}
