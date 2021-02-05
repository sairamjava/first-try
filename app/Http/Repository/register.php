<?php
namespace App\Http\Repository;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;


class register
{
    public function registerRepository($data){
        $response=User::create($data);
        return $response;
    }
}