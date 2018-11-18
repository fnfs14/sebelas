<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use App\_File;
use App\_Poster;

class poster extends Controller
{
    function index(Request $r){
		return view('admin.poster.index');
	}
	function create(Request $r){
		$breadcrumb = "Create";
		$file = _File::get();
		$i = 1;
		return view('admin.poster.form', compact('breadcrumb','file','i'));
	}
	function store(Request $r){
		$id = $this->_uuid('poster','id'); // generate primary key
		$thumbnail = $this->_upload($r,'thumbnail',$id,'poster');
		$query = _Poster::create([
			'id' => $id,
			'judul' => $r->judul,
			'thumbnail' => $thumbnail,
			'publish' => null,
			'isi' => $r->isi,
			'created_at' => now(),
			'updated_at' => null,
			'deleted_at' => null
		]); // store upload
		$this->_flashStore($query,$r->judul);
		return redirect('poster');
	}
}
