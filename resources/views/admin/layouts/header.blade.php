<!-- Header -->
<header id="header" class="header">

	<div class="header-menu">

		<div class="col-sm-12">
			<a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
			<div class="user-area dropdown float-right">
				<a id="" class="menutoggle pull-right" title="Log Out" href="{{ route('logout') }}"
				   onclick="event.preventDefault();
								 document.getElementById('logout-form').submit();">
					<i class="ti-power-off"></i>
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</div>

		</div>
	</div>

</header><!-- /header -->
<!-- Header-->