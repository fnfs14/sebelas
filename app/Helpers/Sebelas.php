<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\_Menu;
 
class Sebelas {
    /**
     * @param int $user_id User-id
     * 
     * @return string
     */
    public static function menu($value){
		$query = _Menu::where('parent',$value);
		return $query;
	}
    public static function BadMethodCallException(){
		// return redirect('/');
		return abort(404);
	}
}