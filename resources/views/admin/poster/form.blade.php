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
					<strong class="card-title txt-transform-capt">{{$breadcrumb}} Poster</strong>
				</div>
				<div class="card-body">
					<form action="{{ url('poster') }}" method="post" enctype="multipart/form-data">
					<table id="" class="table">
						<tbody>
							<tr>
								<th class="width20"><label for="judul">Judul</label></th>
								<th><input type="text" class="form-control" id="judul" name="judul" /></th>
							</tr>
							<tr>
								<th><label for="thumbnail">Thumbnail</label></th>
								<th>
									<input type="file" class="form-control" id="thumbnail" name="thumbnail[]" onchange="readURL(this);" />
									<br hidden />
									<img id="preview_thumbnail" src="#" alt="Thumbnail" hidden />
								</th>
							</tr>
							<tr>
								<th rowspan="2"><label for="isi">Isi</label></th>
								<th>
									<button type="button" class="btn btn-secondary mb-1 float-left btn-sm" data-toggle="modal" data-target="#smallmodal">
										<span class="fa fa-file"></span>
										File
									</button>
								</th>
							</tr>
							<tr>
								<th>
									<textarea name="isi" id="isi"></textarea>
								</th>
							</tr>
							<tr>
								<th><button type="submit" class="btn btn-primary">Save</button></th>
								<th>
									<input name="form_method" type="hidden" value="PATCH">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</th>
							</tr>
						</tbody>
					</table>
					</form>
				</div>
			</div>
            </div><!-- .animated -->
        
	</div> <!-- .content -->
	<div class="modal fade" id="smallmodal" tabindex="-1" role="dialog" aria-labelledby="smallmodalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="smallmodalLabel">Uploaded File</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<table id="bootstrap-data-table-export" class="table table-striped table-bordered">
						<thead>
							<th>No</th>
							<th>Nama</th>
							<th>File</th>
							<th width="20%">Aksi</th>
						</thead>
						<tbody>
						@foreach($file as $a)
							<td>{{ $i++ }}</td>
							<td>{{ $a->nama }}</td>
							<td>
								<input type="text" id="_file{{$i}}" value="{{ asset('upload/file/'. $a->id .'/'. $a->file) }}"
									class="form-control" readonly />
							</td>
							<td class="txt-center" width="20%">
								<a href="{{ asset('upload/file/'. $a->id .'/'. $a->file) }}" class="btn btn-primary btn-sm txt-dec-und"
									target="_blank" title="Open File">
									<span class="fa fa-external-link"></span>
								</a>
								<button type="button" title="Copy" class="btn btn-secondary btn-sm" onclick="copyFile({{$i}})">
									<span class="fa fa-copy"></span>
								</button>
							</td>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script src="{{ asset('js/ckeditor4full/ckeditor.js') }}"></script>
	<script>
		var $ = jQuery;
		// ClassicEditor
			// .create( document.querySelector( '#isi' ) )
			// .catch( error => {
				// console.error( error );
			// } );
		CKEDITOR.replace( 'isi' );
		function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview_thumbnail').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);				
				$("br").prop('hidden',false);
				$("#preview_thumbnail").prop('hidden',false);
            }else{
				$("br").prop('hidden',true);
				$("#preview_thumbnail").prop('hidden',true);
			}
        }
		function copyFile(a) {
			var copyText = document.getElementById("_file"+a);
			copyText.select();
			document.execCommand("copy");
			alert("Copied!");
			$("#smallmodal").modal('hide');
		}
	</script>
@endpush

@section('breadcrumb')
	<div class="breadcrumbs">
		<div class="col-sm-4">
			<div class="page-header float-left">
				<div class="page-title">
					<h1>Poster</h1>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="page-header float-right">
				<div class="page-title">
					<ol class="breadcrumb text-right">
						<li class="">Poster</li>
						<li class="active txt-transform-capt">{{$breadcrumb}}</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
@endpush