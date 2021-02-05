<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class taskController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function tasklist(){
        return view('tasklist');
    }
    function app(){
        return view('app');
    }
    
}
