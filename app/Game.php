<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Game extends Model
{
    public static function SearchName($q, $id_console)
    {
        return static::where('categori_id', $id_console)->where('name', 'LIKE', '%' . $q . '%')->get(); 
    }
    public static function getByID($id, $id_console=false, $name=false)
    {
        return static::where('id', $id)->first();
    }
}
