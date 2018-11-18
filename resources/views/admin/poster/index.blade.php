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
								<th width="10%">Status</th>
								<th width="15%">Aksi</th>
							</tr>
						</thead>
						<tbody>
						@foreach($data as $a)
							<tr>
								<td>{{ $i++ }}</td>
								<td>{{ $a->judul }}</td>
								<td class="txt-center">
									@if($a->publish == "")
									<?php
										$_btn = 'danger';
										$_title = 'Belum dipublikasikan';
										$_icon = 'fa fa-times';
									?>
									@else
									<?php
										$_btn = 'success';
										$_title = 'Sudah dipublikasikan';
										$_icon = 'fa fa-check';
									?>
									@endif
									<button type='button' class='btn btn-{{$_btn}} btn-sm' title='{{$_title}}'>
										<span class='{{$_icon}}'></span>
									</button>
								</td>
								<td class="txt-center">
									<?php
										$_btn = 'secondary';
										$_title = 'Rincian';
										$_link = url('poster/'. $a->id);
										$_icon = 'fa fa-eye';
									?>
									<a href='{{$_link}}' class='btn btn-{{$_btn}} btn-sm' title='{{$_title}}'>
										<span class='{{$_icon}}'></span>
									</a>
									<?php
										$_btn = 'info';
										$_title = 'Ubah';
										$_link = url('poster/'. $a->id .'/edit');
										$_icon = 'fa fa-pencil';
									?>
									<a href='{{$_link}}' class='btn btn-{{$_btn}} btn-sm' title='{{$_title}}'>
										<span class='{{$_icon}}'></span>
									</a>
									@if($a->publish == "")
										{!! Form::open([
                                                'method' => 'POST',
                                                'url' => ['/poster', $a->id],
                                                'style' => 'display:inline'
                                            ]) !!}											
											<input name="_method" type="hidden" value="PATCH">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="deleted_at" value="">
											<input type="hidden" name="publish" value="{{now()}}">
											{!! Form::button('<i class="fa fa-globe" aria-hidden="true"></i>', array(
													'type' => 'submit',
													'class' => 'btn btn-success btn-sm',
													'title' => 'Publikasikan',
													'onclick'=>'return confirm("Anda yakin ingin memublikasikan '.$a->judul.' ?")'
											)) !!}
										{!! Form::close() !!}
									@else
										{!! Form::open([
                                                'method' => 'POST',
                                                'url' => ['/poster', $a->id],
                                                'style' => 'display:inline'
                                            ]) !!}											
											<input name="_method" type="hidden" value="PATCH">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="deleted_at" value="">
											<input type="hidden" name="publish" value="">
											{!! Form::button('<i class="fa fa-globe" aria-hidden="true"></i>', array(
													'type' => 'submit',
													'class' => 'btn btn-danger btn-sm',
													'title' => 'Publikasikan',
													'onclick'=>'return confirm("Anda yakin ingin membatalkan publikasi '.$a->judul.' ?")'
											)) !!}
										{!! Form::close() !!}
									@endif
								</td>
							</tr>
						@endforeach
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