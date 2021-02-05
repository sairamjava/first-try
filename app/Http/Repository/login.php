<?php
namespace App\Http\Repository;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class login{
    public function loginRepository($data){
        if ($data) {
            $userData=User::where(['email'=>$data->email])->select('id','email')->first();
  

           return $userData;
       }     
           
    }
}