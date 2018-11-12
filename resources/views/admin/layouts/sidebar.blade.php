<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
	<nav class="navbar navbar-expand-sm navbar-default">

		<div class="navbar-header">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fa fa-bars"></i>
			</button>
			<a class="navbar-brand" href="{{ url('/') }}">Sebelas</a>
			<a class="navbar-brand hidden" href="{{ url('/') }}">S</a>
		</div>

		<div id="main-menu" class="main-menu collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="">
					<a href="{{ url('/') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
				</li>
				<li class="menu-item-has-children dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-menu-alt"></i>Menu</a>
					<ul class="sub-menu children dropdown-menu">
						<li class=""><i class="ti-layout-menu-v"></i><a href="{{ url('menu/admin') }}">Admin</a></li>
						<li><i class="ti-layout-menu-separated"></i><a href="{{ url('menu/client') }}">Client</a></li>
					</ul>
				</li>
				@foreach($_menu as $a)
					@if(_countTable('menu','parent',$a->id)==0)
						<li class="">
							<a href="{{ url($a->url) }}"> <i class="menu-icon ti-control-record"></i>{{ $a->judul }} </a>
						</li>
					@else
						<li class="menu-item-has-children dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-control-record"></i>{{ $a->judul }}</a>
							<ul class="sub-menu children dropdown-menu">
							@foreach(_getTable('menu','parent',$a->id) as $z)
								<li><i class="ti-control-stop"></i><a href="{{ url($z->url) }}">{{ $z->judul }}</a></li>
							@endforeach
							</ul>
						</li>
					@endif
				@endforeach
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->