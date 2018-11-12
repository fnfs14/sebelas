<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\_Carousel;

class carousel extends Controller
{
    function index(Request $r){
		$data = _Carousel::withTrashed()
			->orderBy('judul', 'ASC')
			->get(); // get all carousel data
		return view('admin.carousel.index',compact('data'));
	}
}
