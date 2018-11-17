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
					<strong class="card-title txt-transform-capt">Poster</strong>
					<a href="{{ url('poster/create') }}" class="btn btn-outline-secondary mb-1 float-right btn-sm">
						<span class="fa fa-plus"></span>
						Tambah
					</a>
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
						</tbody>
					</table>
				</div>
			</div>
            </div><!-- .animated -->
        
	</div> <!-- .content -->
@endsection

@push('scripts')
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
						<li class="active txt-transform-capt">Index</li>
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
	.txt-dec-und {
		text-decoration : underline;
	}
</style>
@endpush