<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Game;


class Exchangegame extends Model
{
    public function game()
    {
        return $this->belongsTo('App\Game', 'gamewish_id', 'id');
    }
    public function game2()
    {
        return $this->belongsTo('App\Game', 'gamehave_id', 'id');
    }
    public static function getAllExch($section, $game1 = false, $game2 = false)
    {
        global $section_id, $wish, $have;
        $section_id = $section;
        $wish = $game1;
        $have = $game2;
        if($wish && $have){
            return static::whereHas('game', function ($query) {
                global $section_id, $wish;
                $query->where('categori_id', $section_id)->where('name', 'LIKE', '%' . $wish . '%');
            })->whereHas('game2', function ($query) {
                global $section_id, $have;
                $query->where('categori_id', $section_id)->where('name', 'LIKE', '%' . $have . '%');
            })->get();
        }elseif($wish){
            return static::whereHas('game', function ($query) {
                global $section_id, $wish;
                $query->where('categori_id', $section_id)->where('name', 'LIKE', '%' . $wish . '%');
            })->whereHas('game2', function ($query) {
                global $section_id;
                $query->where('categori_id', $section_id);
            })->get();
        }elseif($have){
            return static::whereHas('game', function ($query) {
                global $section_id;
                $query->where('categori_id', $section_id);
            })->whereHas('game2', function ($query) {
                global $section_id, $have;
                $query->where('categori_id', $section_id)->where('name', 'LIKE', '%' . $have . '%');
            })->get();
        }else{
            return static::whereHas('game', function ($query) {
                global $section_id;
                $query->where('categori_id', $section_id);
            })->whereHas('game2', function ($query) {
                global $section_id;
                $query->where('categori_id', $section_id);
            })->get();
        }
    }
}
