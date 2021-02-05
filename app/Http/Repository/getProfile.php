<?php
namespace App\Http\Repository;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class getProfile
{
    public function getProfileRepository($arg){
        $data = User::selectRaw('id, name, email')
        ->where('id',$arg)->first();
        return $data;
    }
}
