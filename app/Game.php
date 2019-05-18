<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Game extends Model
{
    public static function SearchName($q)
    {
        return static::where('name', 'LIKE', '%' . $q . '%')->get(); 
    }
}
