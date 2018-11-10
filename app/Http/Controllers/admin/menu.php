<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\_Menu;
use Uuid;
use Validator;

class menu extends Controller
{
    function index(Request $r){
		$i = 1; // increment
		$data = _Menu::withTrashed()
			->where('menu','admin')
			->whereNull('parent')
			->orderBy('judul', 'ASC')
			->get(); // get all menu admin data
		$sub = _Menu::withTrashed()
			->where('menu','admin')
			->whereNotNull('parent')
			->orderBy('judul', 'ASC')
			->get(); // get all sub menu admin data
		return view('admin.menu.admin', compact('data','sub','i'));
	}
	public function store(Request $r){
		$id = Uuid::generate(); // generate primary key
		$query = _Menu::create([
			'id' => $id,
			'judul' => $r->judul,
			'url' => $r->url,
			'parent' => $r->parent,
			'menu' => 'admin',
			'created_at' => now(),
			'updated_at' => null,
			'deleted_at' => null
		]); // store menu
		if(!$query){ // if failed
			$text = 'Gagal menambahkan.';
			$indicator = 'warning';
		}else{ // if success
			$text = 'Berhasil menambahkan ' . $r->judul;
			$indicator = 'success';
		}
		session()->flash('text', $text);
		session()->flash('indicator', $indicator);
		return redirect('menu/admin');
	}
	public function show($id){
		$data = _Menu::withTrashed()->where('id', $id);
		$menu = $data->first();
		$data->restore();
		session()->flash('text', $menu->judul . ' Berhasil dimunculkan.');
		session()->flash('indicator', 'success');
		return redirect('menu/admin');
	}
	public function destroy($id){
        $menu = _Menu::findOrFail($id);
        $menu->delete();
		$sub = _Menu::where('parent',$id)->delete();
		session()->flash('text', $menu->judul . ' Berhasil dihilangkan.');
		session()->flash('indicator', 'warning');
        return redirect('menu/admin');
	}
	public function update(Request $r, $id){
        _Menu::where('id', $id)
			->update([
				'judul' => $r->judul,
				'url' => $r->url,
				'updated_at' => now()
			]);
		session()->flash('text', $r->judul . ' Berhasil diubah.');
		session()->flash('indicator', 'success');
        return redirect('menu/admin');
	}
}
