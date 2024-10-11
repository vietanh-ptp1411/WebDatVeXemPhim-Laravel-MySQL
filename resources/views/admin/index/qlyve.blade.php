@extends('admin.layout')
@section('content')
<div class="page-holder w-100 d-flex flex-wrap">
    <div class="container-fluid px-xl-5">
        <section class="py-5">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-uppercase mb-0">Quản Lý Vé</h6>
                            <a href="" title="Thêm mới" style="position: absolute;right: 35px;top: 22px;">
                                <i class="fas fa-plus-square text-success" style="font-size: 24px"></i>
                            </a>
                        </div>
                        <div class="card-body"> 
                            <table class="table table-hover card-text">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên KH</th>
                                        <th>Tên Phim</th>
                                        <th>Lịch chiếu</th>
                                        <th>Tổng tiền</th>
                                        <th>Tình trạng</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $stt = 0;
                                    if (isset($_GET['page'])) {
                                        $a = $_GET['page'];
                                    } else {
                                        $a = 1;
                                    }
                                    $stt = ($a - 1) * 10;
                                    @endphp
                                    @foreach ($ve as $v)  
                                    @php
                                    $stt++;
                                    @endphp                   		
                                    <tr>
                                        <td>{{$stt}}</td>
                                        <td>{{$v->user->name}}</td> 
										<td>{{$v->lichchieu->phim->tenphim}}</td>
                                        <td>
											{{date('d-m-y', strtotime($v->lichchieu->ngay))}}&nbsp;|&nbsp;{{date('G:i', strtotime($v->lichchieu->time))}}
                                        </td>
										<td>{{number_format($v->tong_gia_ve)}} vnđ</td>	
										<td>
											@if($v->trangthai==0)
												<span>Chờ xác nhận</span>
											@elseif ($v->trangthai==1) 
												<span>Đã xác nhận</span>
											@else
												<span>Đã hủy</span>
											@endif
										</td>	
										<td style="text-align: center;">
											<a href="" class="btn btn-primary">Chi
												tiết</a>
											<a onclick="return confirm('Bạn có muốn hủy đơn hàng này không')"
												href="" class="btn btn-danger">Hủy
												đơn</a>
	
											@if ($v->trangthai != 1)
												<a onclick="return confirm('Bạn có chắc chắn xác nhận đơn hàng này không')"
													href="" class="btn btn-warning">Xác
													nhận</a>
											@endif
	
										</td>
										{{-- <td>
											@php
												$ghes = json_decode($v->ghe); // Giải mã chuỗi JSON
											@endphp
											{{ rtrim(implode( $ghes), ', ') }}
										</td>	
										<td>
											@php
												$combos = json_decode($v->combo); // Giải mã chuỗi JSON
											@endphp
											@if ($combos && count($combos) > 0) 
												{{ rtrim(implode($combos), ', ') }} <!-- Kết hợp các combo thành một chuỗi và loại bỏ dấu phẩy ở cuối -->
											@else
												Không có combo. <!-- Thông báo khi không có combo -->
											@endif
										</td>	 --}}						
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $ve->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 text-center text-md-left text-primary">
                    <p class="mb-2 mb-md-0">Your company &copy; 2024-2025</p>
                </div>
                <div class="col-md-6 text-center text-md-right text-gray-400">
                    <p class="mb-0">Design by <a href="https://bootstrapious.com/admin-templates" class="external text-gray-400">Bootstrapious</a></p>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection
