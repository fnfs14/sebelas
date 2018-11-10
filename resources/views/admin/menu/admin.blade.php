@extends('admin.layouts.main')

@section('content')
	<div class="content mt-3 animated fadeIn">
		@if(session()->has('text') and session()->has('indicator'))
		<div class="col-sm-12">
			<div class="alert  alert-{{session('indicator')}} alert-dismissible fade show" role="alert">
				<span class="badge badge-pill badge-{{session('indicator')}} txt-transform-capt">{{session('indicator')}}</span> {{session('text')}}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
		</div>
		@endif
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">Menu</strong>
					<button type="button" class="btn btn-outline-secondary mb-1 float-right btn-sm" data-toggle="modal" data-target="#smallmodal">
						<span class="ti-plus"></span>
						Tambah
					</button>
				</div>
				<div class="card-body">
					<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="10%">Nomor</th>
								<th>Judul</th>
								<th>URL</th>
								<th width="10%">Status</th>
								<th width="15%">Aksi</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $a)
							<tr role="row" class="even">
								<td>{{ $i++ }}</td>
								<td>{{ $a->judul }}</td>
								<td>{{ $a->url }}</td>
								<td class="txt-center">
									@if($a->deleted_at != "")										
										{!! _btnIcon('danger','ti-close', 'Tidak Aktif') !!} <!-- btn type, icon, title -->
									@else
										{!! _btnIcon('success','ti-check', 'Aktif') !!}
									@endif
								</td>
								<td class="txt-center">
									@if($a->deleted_at != "")										
										{!! _aIcon('secondary','ti-eye', 'Munculkan', url('menu/admin/'.$a->id)) !!}
									@else
										{!! _btnIcon('primary add_submenu','ti-plus', 'Munculkan', $a->id) !!} <!-- btn type classes, icon, title, primary -->
										{!! _btnIcon('info edit_menu','ti-pencil', 'Ubah', $a->id) !!} <!-- btn type classes, icon, title, primary -->
										{!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/menu/admin', $a->id],
                                                'style' => 'display:inline'
                                            ]) !!}
											{!! Form::button('<i class="ti-close" aria-hidden="true"></i>', array(
													'type' => 'submit',
													'class' => 'btn btn-secondary btn-sm',
													'title' => 'Hilangkan',
													'onclick'=>'return confirm("Anda yakin ingin menghilangkan '.$a->judul.' ?")'
											)) !!}
										{!! Form::close() !!}
									@endif
								</td>
							</tr>
							@foreach($sub as $z)
								@if($z->parent==$a->id)
								<tr role="row" class="even">
									<td>{{ $i++ }}</td>
									<td>{{ $z->judul }}</td>
									<td>{{ $z->url }}</td>
									<td class="txt-center">
										@if($z->deleted_at != "")										
											{!! _btnIcon('danger','ti-close', 'Tidak Aktif') !!} <!-- btn type, icon, title -->
										@else
											{!! _btnIcon('success','ti-check', 'Aktif') !!}
										@endif
									</td>
									<td class="txt-center">
										@if($z->deleted_at != "")										
											{!! _aIcon('secondary','ti-eye', 'Munculkan', url('menu/admin/'.$z->id)) !!}
										@else
											{!! _btnIcon('info edit_menu','ti-pencil', 'Ubah', $z->id) !!} <!-- btn type classes, icon, title, primary -->
											{!! Form::open([
													'method' => 'DELETE',
													'url' => ['/menu/admin', $z->id],
													'style' => 'display:inline'
												]) !!}
												{!! Form::button('<i class="ti-close" aria-hidden="true"></i>', array(
														'type' => 'submit',
														'class' => 'btn btn-secondary btn-sm',
														'title' => 'Hilangkan',
														'onclick'=>'return confirm("Anda yakin ingin menghilangkan '.$z->judul.' ?")'
												)) !!}
											{!! Form::close() !!}
										@endif
									</td>
								</tr>
								@endif
							@endforeach
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
            </div><!-- .animated -->
        
	</div> <!-- .content -->
	<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="smallmodalLabel">Tambah Menu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body ajax-form">
					<form action="{{ url('menu/admin') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="text" name="judul" placeholder="Judul" class="form-control mrg5" required />
						<input type="text" name="url" placeholder="URL" class="form-control mrg5" required />
						<input type="hidden" name="parent" placeholder="parent" class="form-control mrg5" />
						<input name="form_method" type="hidden" value="PATCH">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="_confirm()">Confirm</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script>
	var $ = jQuery;
	function _confirm(){
		var judul = $(".ajax-form input[name='judul']").val(); // get form data
		var url = $(".ajax-form input[name='url']").val();
		var parent = $(".ajax-form input[name='parent']").val();
		if(judul==""){ // validation
			alert("Harap isi judul.");
			$(".ajax-form input[name='judul']").focus();
		}else if(url==""){
			alert("Harap isi URL.");
			$(".ajax-form input[name='url']").focus();
		}else{			
			$(".ajax-form form").submit(); // do form submit
		}
	}
	$("#smallmodal").on("hidden.bs.modal", function () { // empty form when modal closed
		$(".ajax-form input[name='id']").attr("name","parent");	
		$(".ajax-form input[name='_method']").attr("name","form_method");	
		$(".ajax-form form").attr("action","{{ url('menu/admin') }}");
		$(".ajax-form input[name='judul']").val("");
		$(".ajax-form input[name='url']").val("");
		$(".ajax-form input[name='parent']").val("");
		$("#smallmodalLabel").html("Tambah Menu");
	});
	$(".add_submenu").click(function(a){
		$('#smallmodal').modal('show'); // show modal
		var btn = $($(a)[0].currentTarget); // get trigger btn
		var tr = btn.parents('tr'); // get current tr
		var judul = tr.find('td:nth-child(2)').html();
		var parent = btn.attr('primary'); // set form data
		$(".ajax-form input[name='parent']").val(parent);
		$("#smallmodalLabel").html("Tambah Sub-menu " + judul);
	});
	$(".edit_menu").click(function(a){
		$('#smallmodal').modal('show'); // show modal
		$(".ajax-form input[name='parent']").attr("name","id");
		var btn = $($(a)[0].currentTarget); // get trigger btn
		var tr = btn.parents('tr'); // get current tr
		var judul = tr.find('td:nth-child(2)').html();
		var url = tr.find('td:nth-child(3)').html();
		var id = btn.attr('primary'); // set form data
		$(".ajax-form form").attr("action","{{ url('menu/admin') }}/"+id);
		$(".ajax-form input[name='form_method']").attr("name","_method");	
		$(".ajax-form input[name='id']").val(id);
		$(".ajax-form input[name='judul']").val(judul);
		$(".ajax-form input[name='url']").val(url);
		$("#smallmodalLabel").html("Edit Menu " + judul);
	});
</script>
@endpush

@section('breadcrumb')
	<div class="breadcrumbs">
		<div class="col-sm-4">
			<div class="page-header float-left">
				<div class="page-title">
					<h1>Menu</h1>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="page-header float-right">
				<div class="page-title">
					<ol class="breadcrumb text-right">
						<li class="">Menu</li>
						<li class="active">Admin</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('styles')
<style>
	.card-title {
		font-size: 20px;
	}
	.mrg5 {
		margin-bottom : 5px;
	}
	.txt-transform-capt {
		text-transform: capitalize;
	}
	.txt-center {
		text-align : center;
	}
</style>
@endpush