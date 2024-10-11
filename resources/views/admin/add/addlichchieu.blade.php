@extends('.admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
	<div class="container-fluid px-xl-5">
		<section class="py-5">
			<div class="row">
				<div class="col-lg-12 mb-5">
					<div class="card">
						<div class="card-header">
							<h3 class="h6 text-uppercase mb-0">Thêm Lịch</h3>
						</div>
						<div class="card-body">
							<form action="{{url('admin/addlich')}}" method="POST" class="form-horizontal">
								{{ csrf_field() }}
								
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Phim</label>
									<div class="col-md-9">
										<select name="phim" class="form-control">
											@foreach ($phim as $p)
												<option value="{{$p->id}}">{{$p->tenphim}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Rạp</label>
									<div class="col-md-9">
										<select name="rap" class="form-control" id="rap">
											<option checked></option>
											@foreach ($rap as $r)
												<option value="{{$r->id}}">{{$r->tenrap}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 form-control-label">Phòng</label>
									<div class="col-md-9">
										<select name="phong" class="form-control" id="phong">
											<option checked></option>
											@foreach ($phong as $ph)
												<option value="{{$ph->id}}">{{$ph->tenphong}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Ngày</label>
									<div class="col-md-9">
										<input id="inputHorizontalWarning" name="ngay" type="date"  class="form-control form-control-warning"><small class="form-text text-muted ml-3">Chú ý :</small>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-3 form-control-label">Thời gian</label>
									<div class="col-md-9">
										<input id="inputHorizontalWarning" name="time" type="time"  class="form-control "><small class="form-text text-muted ml-3">Chú ý :</small>
									</div>
								</div>
								<div class="form-group row">       
									<div class="col-md-9 m-auto">
										<input type="submit" value="ADD" class="btn btn-primary">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	
</script>
@endsection