<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Game extends Model
{
    public static function SearchName($q)
    {
        return static::where('name', 'LIKE', '%' . $q . '%')->get(); 
    }
    public static function getByID($id, $idsection=false, $name=false)
    {
        return static::where('id', $id)->first();
    }
}
