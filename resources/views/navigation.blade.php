<nav class=" navbar-expand-sm bg-dark navbar-dark" >
	<div style="height:50px;padding-top:6px">
		{{-- <div style="float:left;margin-left:500px;">
			<form class="form" action="{{route('search')}}" method="POST">
				{{ csrf_field() }}
				<div class="search">
					<input type="text" class="search1" name="keywordsubmit" placeholder="Tìm kiếm sản phẩm">
					<span class="search2">
						<button type="submit" class="search3" ><i class="fa fa-search"></i></button>
					</span>
				</div>
			</form> 
		</div> --}}
		<div class="collapse navbar-collapse" id="menu" style="float: right; margin-right:20px">
			<ul class="navbar-nav m-auto" >
				<li class="nav-item pl-5">
					<a href="#" class="nav-link">TIN TỨC & ƯU ĐÃI</a>
				</li>
				<li class="nav-item pl-5">
					<a href="#" class="nav-link">VỀ CHÚNG TÔI</a>
				</li>
				<li class="nav-item pl-5">
					<a href="#" class="nav-link">Tìm kiếm</a>
				</li>
			</ul>	
		</div>
	</div>
	<div class="creative_aa">
		{{-- logo --}}
		<a href="#" class="navbar-brand p-0" style="flex:20% ;display: flex; justify-content: center; align-items: center;height:80px"><img src="/anhda4/logo/LOGO11.png" alt="" width="250px" height="100px" style="padding-top: 10px;"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="menu" style="flex:80% ;justify-content: space-between;">
			<ul class="navbar-nav">
				<li class="nav-item dropdown pl-5">
					<a href="#" class="nav-link dropdown-toggle" id="menu2" data-toggle="dropdown">Phim</a>
					<div class="dropdown-menu">
						<a href="{{url('phimdangchieu')}}" class="dropdown-item">Phim đang chiếu</a>
						<a href="{{url('phimsapchieu')}}" class="dropdown-item">Phim sắp chiếu</a>
					</div>
				</li>
				<li class="nav-item pl-5">
					<a href="#" class="nav-link">Mua vé</a>
				</li>
				<li class="nav-item pl-5">
					<a href="#" class="nav-link">Tin Tức</a>
				</li>
				<li class="nav-item pl-5">
					<a href="#" class="nav-link">Rạp</a>
				</li>
				<li class="nav-item pl-5">
					<a href="#" class="nav-link">Hỗ Trợ</a>
				</li>
				<li class="nav-item pl-5">
					<a href="" class="nav-link">Liên Hệ</a>
				</li>
			</ul>
			{{-- đăng nhập --}}
			<ul class="navbar-nav" style="margin-right:100px">
				@if (!Auth::check())
				<div class="dangki">
					<a href="{{ url('dangnhap') }}">Đăng Nhập</a>&nbsp;<span class="text-white">|</span>&nbsp;<a href="{{ url('dangky') }}">Đăng Ký</a>
				</div>
				@else
				<div class="dropdown">
					<div class="text-white dropdown-toggle mr-4" data-toggle="dropdown">{{Auth::user()->name}}</div>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">Profile</a>
						@if (Auth::user()->level==1)
							<a class="dropdown-item" href="{{url('admin')}}">Admin Quản lý</a>
						@else
		
						@endif
						<a class="dropdown-item" href="{{url('dangxuat')}}">Log out</a>	
					</div>
				</div>
				@endif
			</ul>
		</div>
	</div>
</nav>