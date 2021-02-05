<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class userController extends Controller
{
    public function login(Request $request){
        $data = array(array(
            "error"=>"false",
            "message"=>"login success"
        ));
        return $data;
    }
    public function register(Request $request){
       
        return "hi";
    }
}
