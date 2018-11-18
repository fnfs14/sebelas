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
		$data = _Poster::withTrashed()
			->orderBy('judul', 'ASC')
			->get(); // get all poster data
		$i = 1;
		return view('admin.poster.index', compact('data','i'));
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
	function update(Request $r, $id){
        $r = $r->all();
        $data = _Poster::findOrFail($id);
        $query = $data->update($r);
		$this->_flashUpdate($query,$data->judul);
		return redirect('poster');
	}
	function edit(Request $r, $id){
		$breadcrumb = "Edit";
		$file = _File::get();
		$i = 1;
        $data = _Poster::findOrFail($id);
		return view('admin.poster.form', compact('breadcrumb','file','i','data'));
	}
	function show($id){
		$breadcrumb = "Detail";
		$file = _File::get();
		$i = 1;
        $data = _Poster::findOrFail($id);
		return view('admin.poster.form', compact('breadcrumb','file','i','data'));
	}
}
