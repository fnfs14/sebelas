<?php
	function _btnIcon($btn,$icon,$title=NULL,$primary=NULL){
		$btn = "<button type='button' class='btn btn-$btn btn-sm' title='$title' primary='$primary'><span class='$icon'></span></button>";
		return $btn;
	}
	function _aIcon($btn,$icon,$title=NULL,$link=NULL,$confirm=NULL){
		if($confirm!=null){
			$confirm = "return confirm('Anda yakin ingin menghilangkan $confirm ?')";
		}
		$a = "<a href='$link' class='btn btn-$btn btn-sm' title='$title' $confirm><span class='$icon'></span></button>";
		return $a;
	}
?>