<?php
namespace App\Http\Repository;
use App\Http\Utility\Common;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
use Auth;

 class update{
     public function updateRepo($request){
      $userId       = Auth::guard('api')->user()->id;
        $updateData=User::find($userId);
          
        $updateData->name=$request->input('name');
        $updateData->email=$request->input('email');
        
        return $updateData;
     }
    
}