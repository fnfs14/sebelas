<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Uuid;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	
	protected function _uuid($table,$primary){
		$uuid = Uuid::generate();
		$query = DB::table($table)->where($primary,$uuid)->count();
		while($query >= 1) {
			$uuid = Uuid::generate();
			$query = DB::table($table)->where($primary,$uuid)->count();
		}
		return $uuid;
	}
	
	protected function upload($request,$field_name,$id,$folder){
		$files =[];
        $filename = NULL;
		if($request->file($field_name)){
			$files = $request->file($field_name);
			foreach ($files as $file){
				if(!empty($file)){
					$ori_name=$file->getClientOriginalName();
					$filename=str_replace(' ', '', $ori_name);
					$file->move(
						public_path('/upload/'. $folder .'/'. $id .'/'),$filename
					);
					return $filename;
				}
				return $filename;
			}
		}
	}
	
}
