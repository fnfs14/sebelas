<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
 
class Sebelas {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    public static function table($table,$key,$value){
		$query = DB::table($table)->where($key,$value);
		return $query;
	}
    public static function BadMethodCallException(){
		return redirect('/');
	}
}