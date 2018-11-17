<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\_Menu;
use Illuminate\Support\Facades\URL;

class menu extends Controller
{
    function index(Request $r){
		$i = 1; // increment
		$menu = "admin"; // option
		if($r->is('menu/client')){
			$menu = "client";
		}
		$data = _Menu::withTrashed()
			->where('menu',$menu)
			->whereNull('parent')
			->orderBy('judul', 'ASC')
			->get(); // get all menu data
		$sub = _Menu::withTrashed()
			->where('menu',$menu)
			->whereNotNull('parent')
			->orderBy('judul', 'ASC')
			->get(); // get all sub menu data
		return view('admin.menu.index', compact('data','sub','i','menu'));
	}
	public function store(Request $r){
		$menu = "admin";
		if($r->is('menu/client')){
			$menu = "client";
		}
		$id = $this->_uuid('menu','id'); // generate primary key
		$query = _Menu::create([
			'id' => $id,
			'judul' => $r->judul,
			'url' => $r->url,
			'parent' => $r->parent,
			'menu' => $menu,
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
		return redirect('menu/'.$menu);
	}
	public function show(Request $r, $id){
		$_menu = "admin";
		if(strpos($r->url(), 'client')){
			$_menu = "client";
		}
		$data = _Menu::withTrashed()->where('id', $id);
		$menu = $data->first();
		$data->restore();
		session()->flash('text', $menu->judul . ' Berhasil dimunculkan.');
		session()->flash('indicator', 'success');
		return redirect('menu/'.$_menu);
	}
	public function destroy(Request $r, $id){
		$_menu = "admin";
		if(strpos($r->url(), 'client')){
			$_menu = "client";
		}
        $menu = _Menu::findOrFail($id);
        $menu->delete();
		$sub = _Menu::where('parent',$id)->delete();
		session()->flash('text', $menu->judul . ' Berhasil dihilangkan.');
		session()->flash('indicator', 'warning');
        return redirect('menu/'.$_menu);
	}
	public function update(Request $r, $id){
		$menu = "admin";
		if($r->is('menu/client')){
			$menu = "client";
		}
        _Menu::where('id', $id)
			->update([
				'judul' => $r->judul,
				'url' => $r->url,
				'updated_at' => now()
			]);
		session()->flash('text', $r->judul . ' Berhasil diubah.');
		session()->flash('indicator', 'success');
        return redirect('menu/'.$menu);
	}
}
