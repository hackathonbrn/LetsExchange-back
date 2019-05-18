<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Exchangegame;
use App\Game;
use App\User;


class ExchangeController extends Controller
{
    public function listEx(Request $request)
    {
        $idsection = $request->input('id_sec');
        
        $game1 = $request->input('game_wish');
        $game2 = $request->input('game_have');

        $arrFilds = array();
        $list = Exchangegame::getAllExch($idsection, $game1, $game2);
        foreach($list as $v){
            if($v["gamewish_id"])
            $itemWish = Game::getByID($v["gamewish_id"]);

            if($v["gamehave_id"])
            $itemHave = Game::getByID($v["gamehave_id"]);

            if(empty($itemWish) || empty($itemHave))
            continue;

            if($v["user_id"])
            $user = User::getByID($v["user_id"]);

            if(empty($user))
            continue;

            $arrFilds[] = array('ex_id'=>$v["id"], 'user'=>$user, 'gameWish'=>$itemWish, 'gameHave'=>$itemHave);
        }
        return $arrFilds;
    }
}
