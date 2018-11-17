<?php
	function _countTable($table,$key,$value){
		$query = DB::table($table)->where($key,$value)->count();
		return $query;
	}
	function _getTable($table,$key,$value){
		$query = DB::table($table)->where($key,$value)->get();
		return $query;
	}
?>