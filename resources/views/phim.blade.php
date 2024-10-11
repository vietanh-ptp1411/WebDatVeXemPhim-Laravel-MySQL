@extends('master')
@section('title',$tieude)
@section('content')

<div class="container mt-5">
	<div class="row">
		<div class="col-xs-12 col-sm-8 col-md-8">
			<div class="row">
				<div class="col-xs-8 col-sm-4 col-md-4 image">
					<img src="/anhda4/phim/{{$phim->image}}" alt="image" width="100%">
				</div>
				<div class="col-sx-12 col-sm-8 col-md-8">
					<h2 class="text-uppercase title-movie">{{$phim->tenphim}}</h2>
					<h3 class="text-uppercase title-movie en">{{$phim->tentienganh}}</h3>
					<div class="movie-info">
						<div class="info">
							<label>Thời lượng:&nbsp;</label>
							<span>{{$phim->thoiluong}} phút</span>
						</div>
						<div class="info">
							<label>Thể loại:&nbsp;</label>
							<span>{{$phim->theloai}}</span>
						</div>
						<div class="info">
							<label>Nhà sản xuất:&nbsp;</label>
							<span>{{$phim->nsx}}</span>
						</div>
						<div class="info">
							<label>Đạo diễn:&nbsp;</label>
							<span>{{$phim->daodien}}</span>
						</div>
						<div class="info">
							<label>Diễn viên:&nbsp;</label>
							<span>{{$phim->dienvien}}</span>
						</div>
						<div class="info">
							<label>Quốc gia:&nbsp;</label>
							<span>{{$phim->quocgia}}</span>
						</div>
						<div class="info">
							<label>Ngày khởi chiếu:&nbsp;</label>
							<span>{{$phim->ngaykhoichieu}}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row noidungphim">
				<div class="col-12">
					<div class="noidung">
						<h3>Nội Dung Phim</h3>
						<div class="content-text">
							<br>
							<p>{{$phim->noidung}}</p>
						</div>
						<div class="trailer">
							{!!$phim->trailer!!}
						</div>
					</div>
				</div>
			</div>

			<div class="row lichchieu">
				<div class="col-12">
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#home">Lịch Chiếu</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#menu1">Bình Luận</a>
						</li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div id="home" class="container tab-pane active"><br>
							@foreach ($lich as $l)
							<div class="lich mb-4">
								<div class="tenrap">
									<h5>{{$l->rap->tenrap}}</h5>
								</div>
								<div class="chitietlich">
										@foreach ($l['ngay'] as $n)
									<span>
											<strong>{{date('d-m-Y', strtotime($n->ngay))}}</strong>
								
										
									</span>
									<ul>
										@foreach ($n['id_phong'] as $phim)
										<div class="mb-4">
											<span class="lichphong">{{$phim->phong->tenphong}}</span>
										
										@foreach ($phim['time'] as $t)
											
											<a href="datve/{{$t->id}}"><li>{{date('G:i',strtotime($t->time))}}</li></a>
										@endforeach
											</div>
									@endforeach
										
										
									</ul>
										@endforeach
								</div>
							</div>
							@endforeach
							
						</div>
						<div id="menu1" class="container tab-pane fade"><br>
							<div class="cmt">
								<form action="cmt/{{$phim->id}}" method="POST">
									@csrf
								<textarea class="form-control" name="noidungcmt">
								</textarea>
								<div>
									<button type="submit" class="btn btn-outline-primary float-right mt-3">Bình Luận</button>
								</div>
								</form>
							</div>
							<div >
								@foreach ($cmtphim as $cmtp)
									<div class="comment">
									<!-- Comment Avatar -->
									<div class="comment-avatar">
										<img src="/anhda4/logo/avt.png">
									</div>

									<!-- Comment Box -->
									<div class="comment-box mt-2">
										<div class="comment-text">{{$cmtp->noidung}}</div>
										<div class="comment-footer">
											<div class="comment-info">
												<span class="comment-author">
													<a href="">{{$cmtp->user->name}}</a>
												</span>
												<span class="comment-date">{{$cmtp->create_at}}</span>
											</div>

											<div class="comment-actions">
												<a href="#">Reply</a>
											</div>
										</div>
									</div>
								</div>
								@endforeach
								
						
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		


		<div class="col-xs-12 col-sm-4 col-md-4">
			<h3 class="phimlienquan">Phim Đang Chiếu</h3>
			<div class="row">
				@foreach($phimlq as $plq)
				<div class="col-12 ">
					<div class="movie movielienquan">
						<img src="/anhda4/phim/{{$plq->image}}" alt="image" width="100%">
						<div class="decription-hover">
							<a href="{{url('phim',$plq->id)}}"><button class="btn btn-outline-secondary">Xem chi tiết</button></a>
						</div>
					</div>
					<div class="title-plq">
						<h4 class="text-uppercase">{{$plq->tenphim}}</h4>
						<h4 class="text-uppercase en">{{$plq->tentienganh}}</h4>
					</div>
				</div>
				@endforeach
			</div>
			<button class="btn btn-outline-info mt-4 nutxemthem"> Xem Thêm</button>
		</div>
	</div>
</div>
@endsection