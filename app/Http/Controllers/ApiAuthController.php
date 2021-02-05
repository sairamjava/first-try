<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Http\Service\UserService;
use App\Http\Utility\Common;
use App\Http\Utility\Message;
use App\Http\Repository\register;
use App\Http\Repository\login;
use App\Http\Repository\update;
use App\Http\Repository\delete;
use App\User;
use App\Http\Utility\Defaults;
use Illuminate\Support\Facades\Response;

class ApiAuthController extends Controller
{
  public function register(Request $request)
  {

    $rules=[
        'name'=>'required|max:50',
        'email'=>'required|email|unique:users',
        'password'=>'required|confirmed'
    ];
    $validator  = Validator::make($request->all(), $rules);
    if ($validator->fails())
{
    $data    = $validator->messages();
   $response['error']  = Common::error_true;
    $response['Message']  = $data->first();
}   
else
{
    $registerrepo    = new UserService();
    $response=$registerrepo->addUser($request);
}   

return $response ;
  }

  
  public function login(Request $request)
  {
    $response   = new Response();
    $rules=[
        'email'=>'required|email',
        'password'=>'required'
    ];
    $validator  = Validator::make($request->all(), $rules);
   if ($validator->fails())
   {
       
    $data      = $validator->messages();
    $response  = Common::error_true;
    $response  = $data->first();  
   }
   else{ 
       $loginrepo= new UserService();
       $response=$loginrepo->login($request);   
   }
  $response = Defaults::encode($response);
   return $response;
     }
   

  public function getProfile(Request $request)
  {
    $userId      = Auth::guard('api')->user()->id;
    $userService  = new UserService();
    $response     = $userService->getProfile($userId);
    return $response;
 
    }
    public function update(Request $request){
       
        $response   = new Response();
        $rules=$request->validate([
            'name'=>'required|max:50',
            'email'    => 'required|email',
        ]);
        if (!$rules) {
              $data = $rules->messages();
            $response  = Common::error_true;
         $response = $data->first();
        } 
        else{
            $userService            = new UserService();
            $response               = $userService->updateProfile($request);
        }
        $responsedata = Defaults::encode($response);
        return $responsedata;
    }

    public function delete(Request $request){
       
        $deleterepo    = new UserService();
    $userId      = Auth::guard('api')->user()->id;
        $deleteData=$deleterepo->deleteProfile($userId);
        $responsedata = Defaults::encode($deleteData);
      return $responsedata;
    }
  }


