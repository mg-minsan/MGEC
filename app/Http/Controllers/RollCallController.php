<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RollCallController extends Controller
{

    public function token(Request $request){
        return view('rollCall.token');
    }

    public function generateToken(Request $request){
        return rand(1, 100000);
    }





    
}
