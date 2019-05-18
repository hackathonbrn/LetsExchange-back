<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Game;

class GameController extends Controller
{
    public function searchGame(Request $request, $params)
    {
        $query = $request->input('query');
        $noArray = array('name'=>'Ничего не найдено');
        if(!empty($query)){
            $objSerch = Game::SearchName($query);
            if(empty(json_decode($objSerch))){
                return json_encode($noArray);
            }
        }
    }
}
