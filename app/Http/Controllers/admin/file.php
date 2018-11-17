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
		$file = $this->upload($r,'file',$id,'file');
		$query = _File::create([
			'id' => $id,
			'nama' => $r->nama,
			'file' => $file,
			'created_at' => now(),
			'updated_at' => null,
			'deleted_at' => null
		]); // store upload
		if(!$query){ // if failed
			$text = 'Gagal menambahkan.';
			$indicator = 'warning';
		}else{ // if success
			$text = 'Berhasil menambahkan ' . $r->judul;
			$indicator = 'success';
		}
		session()->flash('text', $text);
		session()->flash('indicator', $indicator);
		return redirect('file');
	}
	public function destroy(Request $r, $id){
        $data = _File::findOrFail($id);
        $data->delete();
		session()->flash('text', $data->nama . ' Berhasil dihilangkan.');
		session()->flash('indicator', 'warning');
        return redirect('file');
	}
	public function show(Request $r, $id){
		$data = _File::withTrashed()->where('id', $id);
		$file = $data->first();
		$data->restore();
		session()->flash('text', $file->file . ' Berhasil dimunculkan.');
		session()->flash('indicator', 'success');
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
		$file = $this->upload($r,'file',$id,'file');
        _File::where('id', $id)
			->update([
				'nama' => $r->nama,
				'file' => $file,
				'updated_at' => now()
			]);
		session()->flash('text', $r->nama . ' Berhasil diubah.');
		session()->flash('indicator', 'success');
        return redirect('file');
	}
}
