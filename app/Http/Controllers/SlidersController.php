<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Slider;

class SlidersController extends Controller
{
    public function listSliders()
    {
        $list = Slider::allSliders();
        return $list;
    }
}
