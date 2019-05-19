<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Game;

class GameController extends Controller
{
    public function searchGame(Request $request)
    {
        $query = $request->input('query');
        $id_console = $request->input('id_console');

        $noArray = array('success'=>false, 'mess'=>'Ничего не найдено');
        if(!empty($query)){
            $objSerch = Game::SearchName($query, $id_console);
            if(empty(json_decode($objSerch))){
                return json_encode($noArray);
            }else{
                return array('success'=>true, 'exch'=>$objSerch);
            }
        }
    }
}
