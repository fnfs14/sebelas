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
					<strong class="card-title txt-transform-capt">Upload</strong>
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
								<th>Nama</th>
								<th>File</th>
								<th width="10%">Aksi</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $a)
							<tr>
								<td>{{ $i++ }}</td>
								<td>{{ $a->nama }}</td>
								<td>
									<a href="{{ asset('upload/file/'. $a->id .'/'. $a->file) }}" class="txt-dec-und" target="_blanl">
										{{ $a->file }}
									</a>
								</td>
								<td class="txt-center">
									{!! _btnIcon('info edit_file','fa fa-pencil', 'Ubah', $a->id) !!} <!-- btn type classes, icon, title, primary -->
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
            </div><!-- .animated -->
        
	</div> <!-- .content -->
	<!-- loader -->
	<div class="modal fade" id="loader" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content loader">
			</div>
		</div>
	</div>
	<!-- modal -->
	<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="smallmodalLabel">Tambah File</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body ajax-form">
					<form action="{{ url('file') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="text" name="nama" placeholder="Nama" class="form-control mrg5" maxlength="255" required />
						<input type="file" name="file[]" id="file" placeholder="File" class="form-control mrg5" required />
						<p class="curr_file" hidden>Current file : <a href="#" class="txt-dec-und" target="_blank">asd</a></p>
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
	var _url = "{{ url('file/') }}";
	var _public = "{{ asset('upload/file') }}";
</script>
<script src="{{ asset('js/admin/file.js') }}"></script>
@endpush

@section('breadcrumb')
	<div class="breadcrumbs">
		<div class="col-sm-4">
			<div class="page-header float-left">
				<div class="page-title">
					<h1>Upload</h1>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="page-header float-right">
				<div class="page-title">
					<ol class="breadcrumb text-right">
						<li class="">Upload</li>
						<li class="active txt-transform-capt">Index</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/spin.css') }}">
@endpush