<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConstController extends Controller
{
    public function __invoke()
    {
        $list = \Config::get('const');
        return response()->json(['const' => $list]);
    }
}
