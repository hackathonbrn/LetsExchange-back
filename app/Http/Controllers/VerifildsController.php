<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class VerifildsController extends Controller
{
    public function VirifildApp(Request $request)
    {
        $query = $request->all();
        $key=\Config::get('global_param.mobi_key');
        if($query["APP_KEY"] == $key){
            echo json_encode(array('BACK_KEY'=>csrf_token()));
        }else{
            echo json_encode(array('error'=>'Y'));
        }
    }
}
