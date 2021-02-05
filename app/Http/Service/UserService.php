<?php

namespace App\Http\Service;
use Illuminate\Http\Request;
use App\Http\Utility\Common;
use App\User;
use DB;
use App\Http\Repository\register;
use App\Http\Repository\login;
use App\Http\Repository\getProfile;
use App\Http\Repository\update;
use App\Http\Repository\delete;
use App\Http\Service\DataService;
use Illuminate\Support\Facades\Auth;

class UserService{
public function addUser($arg)
{
    if (!empty($arg)) {
        $password=bcrypt($arg->password);
        $details = array("name"=>$arg->name,"email"=> $arg->email,"password" => $password);
        $registerrepo= new register();
        $registerRepoData       = $registerrepo->registerRepository($details);
        $data = array("name"=>$arg->name,"email"=> $arg->email,"id"=>$registerRepoData->id);
    }
    else{
        $data->error        = Common::error_true;
        $data->errorMessage = "No Data";
    }
    return $data;
}
public function login($arg){
    $data           = new DataService();
    $userRepository  = new login();
    $users           = $userRepository->loginRepository($arg);
    $validator =Auth::attempt(['email'=>request('email'),'password'=>request('password')]);
    
    if($validator){
        $data->error        = Common::error_false;
        $data->errorMessage = "LoggedIn succesfully";
        $data->accessToken=$users->createToken('access_token')->accessToken;
        $data->userDetail=$users;
       
    }
    else{
        $data->error        = Common::error_true;
        $data->errorMessage = "No Data";
    }
return $data;
}

public function getprofile($arg)
{
  
    try{
        $userId=new getProfile();
        $data=$userId->getProfileRepository($arg);

    }catch(\Illuminate\Database\QueryException $ex){

        $jsonresp = $ex->getMessage();
        return false;
    }
    return $data;

}
public function updateProfile($arg)
{
    $userRepository = new update();
    $update     = $userRepository->updateRepo($arg);
    $data       = new DataService();
    if ($update) {
        $data->error        = Common::error_false;
        $data->Message ="Uploaded succesfully";
    }
    else{
        $data->error        = Common::error_true;
        $data->errorMessage = "No Data";
    }
   
return $data;
}

public function deleteProfile($arg){
    $userRepository = new delete();
    $update     = $userRepository->deleteRepo($arg);
    $data       = new DataService();
    if ($update) {
        $data->error        = Common::error_false;
        $data->Message ="Deleted succesfully";
    }
    else{
        $data->error        = Common::error_true;
        $data->errorMessage = "upload a valid id";
    }
    return $data;
}


}