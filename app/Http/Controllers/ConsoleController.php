<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Category;

class ConsoleController extends Controller
{
    public function listConsole()
    {
        $list = Category::allConsole();
        return $list;
    }
}
