<?php
namespace App\Http\Repository;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;
 
class delete{
    public function deleteRepo($id){
        $deleteData=User::where('id',$id)->delete();

        return $deleteData;
    }
}