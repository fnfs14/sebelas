<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class poster extends Controller
{
    function index(Request $r){
		return view('admin.poster.index');
	}
	function create(Request $r){
		$breadcrumb = "Create";
		return view('admin.poster.form', compact('breadcrumb'));
	}
}
