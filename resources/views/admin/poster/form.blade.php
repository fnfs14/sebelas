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
					<table id="" class="table">
						<tbody>
							<tr>
								<th class="width20"><label for="judul">Judul</label></th>
								<th><input type="text" class="form-control" id="judul" name="judul" /></th>
							</tr>
							<tr>
								<th><label for="thumbnail">Thumbnail</label></th>
								<th>
									<input type="file" class="form-control" id="thumbnail" name="thumbnail" onchange="readURL(this);" />
									<br hidden />
									<img id="preview_thumbnail" src="#" alt="Thumbnail" hidden />
								</th>
							</tr>
							<tr>
								<th><label for="isi">Isi</label></th>
								<th><textarea name="isi" id="isi"></textarea></th>
							</tr>
							<tr>
								<th><button type="button" class="btn btn-primary" onclick="_z()">Save</button></th>
								<th>
									<input name="form_method" type="hidden" value="PATCH">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
								</th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
            </div><!-- .animated -->
        
	</div> <!-- .content -->
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
            }
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
<style>
	.card-title {
		font-size: 20px;
	}
	.width20 {
		width : 20%;
	}
</style>
@endpush