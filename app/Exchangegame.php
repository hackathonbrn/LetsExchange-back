<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;


class Exchangegame extends Model
{
    protected $fillable = ['user_id', 'gamewish_id', 'gamehave_id', 'phone', 'description'];
    public function game()
    {
        return $this->belongsTo('App\Game', 'gamewish_id', 'id');
    }
    public function game2()
    {
        return $this->belongsTo('App\Game', 'gamehave_id', 'id');
    }
    public static function getAllExch($id_console, $game1 = false, $game2 = false, $user_id)
    {
        global $section_id, $wish, $have;
        $section_id = $id_console;
        $wish = $game1;
        $have = $game2;
        if($wish && $have){
            return static::where('user_id', '!=', $user_id)->whereHas('game', function ($query) {
                global $section_id, $wish;
                $query->where('categori_id', $section_id)->where('name', 'LIKE', '%' . $wish . '%');
            })->whereHas('game2', function ($query) {
                global $section_id, $have;
                $query->where('categori_id', $section_id)->where('name', 'LIKE', '%' . $have . '%');
            })->get();
        }elseif($wish){
            return static::where('user_id', '!=', $user_id)->whereHas('game', function ($query) {
                global $section_id, $wish;
                $query->where('categori_id', $section_id)->where('name', 'LIKE', '%' . $wish . '%');
            })->whereHas('game2', function ($query) {
                global $section_id;
                $query->where('categori_id', $section_id);
            })->get();
        }elseif($have){
            return static::where('user_id', '!=', $user_id)->whereHas('game', function ($query) {
                global $section_id;
                $query->where('categori_id', $section_id);
            })->whereHas('game2', function ($query) {
                global $section_id, $have;
                $query->where('categori_id', $section_id)->where('name', 'LIKE', '%' . $have . '%');
            })->get();
        }else{
            return static::where('user_id', '!=', $user_id)->whereHas('game', function ($query) {
                global $section_id;
                $query->where('categori_id', $section_id);
            })->whereHas('game2', function ($query) {
                global $section_id;
                $query->where('categori_id', $section_id);
            })->get();
        }
    }
}
