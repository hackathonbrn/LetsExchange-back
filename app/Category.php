<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function allConsole()
    {
        return static::all(); 
    }
    public static function getByConsole($id)
    {
        return static::where('id',$id)->get(); 
    } 
}
