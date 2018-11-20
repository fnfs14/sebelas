<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use App\_File;
use App\_Berita;

class berita extends Controller
{
    function index(Request $r){
		$data = _Berita::withTrashed()
			->orderBy('judul', 'ASC')
			->get(); // get all berita data
		$i = 1;
		return view('admin.berita.index', compact('data','i'));
	}
	function create(Request $r){
		$breadcrumb = "Create";
		$file = _File::get();
		$i = 1;
		return view('admin.berita.form', compact('breadcrumb','file','i'));
	}
	function store(Request $r){
		$id = $this->_uuid('berita','id'); // generate primary key
		$thumbnail = $this->_upload($r,'thumbnail',$id,'berita');
		$query = _Berita::create([
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
		return redirect('berita');
	}
	function show($id){
		$breadcrumb = "Detail";
		$file = _File::get();
		$i = 1;
        $data = _Berita::findOrFail($id);
		return view('admin.berita.form', compact('breadcrumb','file','i','data'));
	}
	function edit(Request $r, $id){
		$breadcrumb = "Edit";
		$file = _File::get();
		$i = 1;
        $data = _Berita::findOrFail($id);
		return view('admin.berita.form', compact('breadcrumb','file','i','data'));
	}
	function update(Request $r, $id){
        $data = _Berita::findOrFail($id);
		if(isset($r['thumbnail'])){
			$thumbnail = $this->_upload($r,'thumbnail',$id,'berita');
			$r = $r->all();
			$r['thumbnail'] = $thumbnail;
		}else{
			$r = $r->all();
		}
        $query = $data->update($r);
		$this->_flashUpdate($query,$data->judul);
		return redirect('berita');
	}
}
