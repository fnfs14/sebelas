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
					<strong class="card-title txt-transform-capt">{{$menu}}</strong>
					<button type="button" class="btn btn-outline-secondary mb-1 float-right btn-sm" data-toggle="modal" data-target="#smallmodal">
						<span class="fa fa-plus"></span>
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
								<td>
									<a href="{{ url($a->url) }}" class="txt-dec-und">{{ $a->url }}</a>
								</td>
								<td class="txt-center">
									@if($a->deleted_at != "")										
										{!! _btnIcon('danger','fa fa-times', 'Tidak Aktif') !!} <!-- btn type, icon, title -->
									@else
										{!! _btnIcon('success','fa fa-check', 'Aktif') !!}
									@endif
								</td>
								<td class="txt-center">
									@if($a->deleted_at != "")										
										{!! _aIcon('secondary','fa fa-eye', 'Munculkan', url('menu/'.$menu.'/'.$a->id)) !!}
									@else
										{!! _btnIcon('primary add_submenu','fa fa-plus', 'Munculkan', $a->id) !!} <!-- btn type classes, icon, title, primary -->
										{!! _btnIcon('info edit_menu','fa fa-pencil', 'Ubah', $a->id) !!} <!-- btn type classes, icon, title, primary -->
										{!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/menu/'.$menu, $a->id],
                                                'style' => 'display:inline'
                                            ]) !!}
											{!! Form::button('<i class="fa fa-eye-slash" aria-hidden="true"></i>', array(
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
									<td>
										<a href="{{ url($z->url) }}" class="txt-dec-und">{{ $z->url }}</a>
									</td>
									<td class="txt-center">
										@if($z->deleted_at != "")										
											{!! _btnIcon('danger','fa fa-eye-slash', 'Tidak Aktif') !!} <!-- btn type, icon, title -->
										@else
											{!! _btnIcon('success','fa fa-check', 'Aktif') !!}
										@endif
									</td>
									<td class="txt-center">
										@if($z->deleted_at != "")										
											{!! _aIcon('secondary','fa fa-eye', 'Munculkan', url('menu/'.$menu.'/'.$z->id)) !!}
										@else
											{!! _btnIcon('info edit_menu','fa fa-pencil', 'Ubah', $z->id) !!} <!-- btn type classes, icon, title, primary -->
											{!! Form::open([
													'method' => 'DELETE',
													'url' => ['/menu/'.$menu, $z->id],
													'style' => 'display:inline'
												]) !!}
												{!! Form::button('<i class="fa fa-eye-slash" aria-hidden="true"></i>', array(
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
					<form action="{{ url('menu/'.$menu) }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="text" name="judul" placeholder="Judul" class="form-control mrg5" maxlength="255" required />
						<input type="text" name="url" placeholder="URL" class="form-control mrg5" maxlength="255" required />
						<input type="hidden" name="parent" placeholder="parent" class="form-control mrg5" />
						<input name="form_method" type="hidden" value="PATCH">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="_confirm()">Save</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script>
	var _url = "{{ url('menu/'.$menu) }}";
</script>
<script src="{{ asset('js/admin/menu.js') }}"></script>
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
						<li class="active txt-transform-capt">{{$menu}}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
@endpush