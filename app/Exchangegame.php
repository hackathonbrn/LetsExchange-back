<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;


class Exchangegame extends Model
{
    public static function getAllExch($section, $game1 = false, $game2 = false)
    {
        if($game1 && $game2){
            return static::where('gamewish_id', $game1)->where('gamehave_id', $game2)
            ->leftJoin('games', 'exchangegames.gamewish_id', '=', 'games.id')
            ->where('categori_id', $section)->get();
        }elseif($game1){
            return static::where('gamewish_id', $game1)
            ->leftJoin('games', 'exchangegames.gamewish_id', '=', 'games.id')
            ->where('categori_id', $section)->get();
        }elseif($game2){
            return static::where('gamehave_id', $game2)
            ->leftJoin('games', 'exchangegames.gamehave_id', '=', 'games.id')
            ->where('categori_id', $section)->get();
        }else{
            return static::leftJoin('games', 'exchangegames.gamewish_id', '=', 'games.id')
            ->where('categori_id', $section)->get();
        }   
    }
}
