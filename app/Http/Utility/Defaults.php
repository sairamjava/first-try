<?php

namespace App\Http\Utility;
use App\Http\Controllers;

final class Defaults{

	public static function  encode($data){
		$encodedata=json_encode($data);
		return $encodedata;
    }
}
