<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use App\_File;

class file extends Controller
{
    function index(Request $r){
		$i = 1; // increment
		$data = _File::withTrashed()
			->orderBy('nama', 'ASC')
			->get(); // get all file data
		return view('admin.file.index', compact('data','i'));
	}
	function store(Request $r){
		$id = $this->_uuid('file','id'); // generate primary key
		$file = $this->_upload($r,'file',$id,'file');
		$query = _File::create([
			'id' => $id,
			'nama' => $r->nama,
			'file' => $file,
			'created_at' => now(),
			'updated_at' => null,
			'deleted_at' => null
		]); // store upload
		$this->_flashStore($query,$r->nama);
		return redirect('file');
	}
	public function edit(Request $r, $id){
		$data = _File::withTrashed()->where('id', $id)->first();
		$data = [
			'nama' => $data->nama,
			'file' => $data->file,
		];
		return json_encode($data);
	}
	public function update(Request $r, $id){
		$file = $this->_upload($r,'file',$id,'file');
        $query = _File::where('id', $id)
			->update([
				'nama' => $r->nama,
				'file' => $file,
				'updated_at' => now()
			]);
		$this->_flashUpdate($query,$r->nama);
        return redirect('file');
	}
}
