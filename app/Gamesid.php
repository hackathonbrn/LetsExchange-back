<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;

class Gamesid extends Model
{
    public static function getExchGameWish($id)
    {
        $arGameWish = array();
        $listWish = static::where('exchangegame_id', $id)->get();
        foreach($listWish as $v){
            $arGameWish[] = Game::getByID($v["game_id"]);
        }
        return $arGameWish;
    }
}
