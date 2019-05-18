<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;


class Gamestwoid extends Model
{
    public static function getExchGameHave($id)
    {
        $arGameHave = array();
        $listHave = static::where('exchangegame_id', $id)->get();
        foreach($listHave as $v){
            $arGameHave[] = Game::getByID($v["game_id"]);
        }
        return $arGameHave;
    }
}
