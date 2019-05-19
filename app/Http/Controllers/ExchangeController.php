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
        $id_console = $request->input('id_console');
        
        $game1 = $request->input('game_wish');
        $game2 = $request->input('game_have');
        $user_id = $request->input('user_id');

        $arrFilds = array();
        $list = Exchangegame::getAllExch($id_console, $game1, $game2, $user_id);
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

            $arrFilds[] = array('ex_id'=>$v["id"], 'ex_all'=>$v, 'user'=>$user, 'gameWish'=>$itemWish, 'gameHave'=>$itemHave);
        }
        return $arrFilds;
    }
    public function addExchange(Request $request)
    {
        $user_id = $request->input('user_id');
        $wish_id = $request->input('game_wish');
        $have_id = $request->input('game_have');
        $phone = $request->input('phone');
        $description = $request->input('description');

        if($user_id && $wish_id && $have_id && $phone){
            $exchange = Exchangegame::create([
                'user_id' => $user_id, 
                'gamewish_id' => $wish_id, 
                'gamehave_id' => $have_id,
                'phone' => $phone,
                'description' => $description,
            ]);
        }
        
        if($exchange){
            return response()->json(['success' => true, 'exch' => $exchange]);
        }else{
            return response()->json(['success' => false, 'error' => "noAddExchange"]);
        }
    }
}
