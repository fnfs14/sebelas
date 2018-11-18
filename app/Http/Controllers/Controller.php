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
	
	protected function _upload($request,$field_name,$id,$folder){
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
	
	protected function _flashStore($query,$r){
		if(!$query){ // if failed
			$text = 'Gagal menambahkan.';
			$indicator = 'warning';
		}else{ // if success
			$text = 'Berhasil menambahkan ' . $r;
			$indicator = 'success';
		}
		session()->flash('text', $text);
		session()->flash('indicator', $indicator);
	}
	
	protected function _flashDestroy($query,$r){
		if(!$query){ // if failed
			$text = 'Gagal dihilangkan.';
		}else{ // if success
			$text = $r . ' Berhasil dihilangkan.';
		}
		session()->flash('text', $text);
		session()->flash('indicator', 'warning');
	}
	
	protected function _flashShow($query,$r){
		if(!$query){ // if failed
			$text = 'Gagal dimunculkan.';
			$indicator = "warning";
		}else{ // if success
			$text = $r . ' Berhasil dimunculkan.';
			$indicator = "success";
		}
		session()->flash('text', $text);
		session()->flash('indicator', $indicator);
	}
	
	protected function _flashUpdate($query,$r){
		session()->flash('text', $r . ' Berhasil diubah.');
		session()->flash('indicator', 'success');
	}
	
}
