@extends('master')
@section('content')
@php
$idl=null;
foreach ($lichchieu as $lc) 
	$idl=$lc->id

@endphp
<div class="container">
	<div class="row">
		<div class="col-sm-9" style="background-color: #f26b38;margin-top: 50px">
			<div style="position: relative;">
				<div class="booking" >
					<table class="table mt-3">
						<thead class="thead-dark">
							<tr>
								<th style="width: 50%">Vé</th>
								<th style="width: 15%">Số lượng</th>
								<th style="width: 15%">Giá(VNĐ)</th>
								<th style="width: 20%">Tổng(VNĐ)</th>
							</tr>
						</thead>
						<tbody>
							<tr style="background-color: #f9f9f9">
								<td>
									@foreach ($lichchieu as $l)
									<span>{{$l->phim->tenphim}}</span>
									@endforeach
									
								</td>
								<td><div>
									<input class="slve" type="number" id="Numseats" style="width: 50px;" value="0" min="0" onchange="tienve()">
								</div></td>
								<td id="giave">{{$l->phim->giave}}</td>
								<td><span class="tongtienve"></span>&nbsp;vnđ</td>
							</tr>
						</tbody>
					</table>
					<h4 style="color: white;padding: 10px;">CHỌN COMBO</h4>
					<table class="table" id="tb">
						<thead class="thead-dark">
							<tr>
								<th style="width: 50%">Combo</th>
								<th style="width: 15%">Số lượng</th>
								<th style="width: 15%">Giá(VNĐ)</th>
								<th style="width: 20%">Tổng(VNĐ)</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($cb as $c)
							<tr style="background-color: #f9f9f9">
								<td>
									<span id="tencb">{{$c->tencombo}}</span><br>
									<span style="font-size: 14px;">{{$c->chitiet}}</span>
								</td>
								<td><div>

									<input class="units-class combo" type="number" id="{{$c->tencombo}}-{{$c->id}}" style="width: 50px;" value="0" min="0" onchange="calculate()">

								</div></td>
								<td>{{number_format($c->gia)}}</td>
								<td><span class="subtotal-class"></span>&nbsp;vnđ</td>
							</tr>
							@endforeach


						</tbody>
					</table>
				</div>
				<div class="seatbooking" style="background-color: #fff;height: 600px">

					<div class="inputForm">
					</div>


					<div class="seatStructure">
						<center>
							<div class="screen">SCREEN</div>
							<div class="seatcolor">
								<span class="seat-gray">Ghế đã bán</span>
								<span class="seat-blue">Có thể chọn</span>
								<span class="seat-green">Ghế đang chọn</span>
							</div>
							<div class="seatBooking">
								@foreach ($ghe as $g)
								<div class="seatRow">
									<div class="seatRowName">
										{{$g->row}}
									</div>
									@foreach ($g['number'] as $n)
									@if (($n->ve->id_lichchieu== $idl ) && ($n->ve->id_user !=null))
									<div id="{{$n->id}}" class="seatNumber seatDisable" value="{{$n->row}}{{$n->number}}">{{$n->number}}</div>
									@else
									<div id="{{$n->id}}" class="seatNumber" value="{{$n->row}}{{$n->number}}">{{$n->number}}</div>
									@endif
									@endforeach
								</div>
								@endforeach
								<div class="seatReceipt">
									<button class="btnClear">Clear</button>
								</div>
							</div>
						</center>
					</div>
					<br/><br/>
				</div>
				<button class="tt" style="float: right;margin-bottom: 10px;border: 1px solid;padding: 10px 15px">Tiếp Tục</button>
			</div>
		</div>
		<div class="col-sm-3" style="margin-top: 50px">
			<div style="background-color: #f9f9f9">
				@foreach ($lichchieu as $l)
				<input type="hidden" class="idlich" value="{{$l->id}}">
				@if (Auth::check())
				<input type="hidden" class="iduser" value="{{Auth::user()->id}}">
				@endif
				<div class="col-md-12" style="text-align: center;">
					<img src="/anhda4/phim/{{$l->phim->image}}" width="215" height="150">
				</div>
				<div class="col-md-12">
					<div>
						<h4 style="font-size: 16px" id="tenphim">{{$l->phim->tenphim}}</h4>
					</div>
					<div>
						<p><b>Rạp:</b>&nbsp;<span id="tenrap">{{$l->rap->tenrap}}</span></p>
						<p><b>Phòng:</b>&nbsp;<span id="tenphong">{{$l->phong->tenphong}}</span></p>
						<p><b>Suất chiếu:</b>&nbsp;<span id="ngay">{{date('d-m-Y', strtotime($l->ngay))}}</span>&nbsp;|&nbsp;<span id="thoigian">{{date('G:i',strtotime($l->time))}}</span></p>
						@endforeach
						<div><b>Combo:</b>&nbsp;<div class="comboList"></div></div>
						<div><b>Ghế:</b>&nbsp;<div class="seatList"></div> </div>
					</div>
					<div>
						<p><b>Tổng:</b><span id="total"> </span>&nbsp;VNĐ</p>
					</div>
					<div>
						@if (!Auth::check())
						<p class="text-danger">Đăng nhập để tiếp tục</p>
						@else
						<center>
						<button id="addve" class="datve">Đặt vé</button>	
						</center>			
						@endif

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">	
	$(document).ready(function() {
		$(".seatNumber").click(function() {
			var selectedSeats = parseInt($(".seatSelected").length);
			if (selectedSeats == $("#Numseats").val()) {
				if ($(this).hasClass("seatSelected")) {
					var thisName = $(this).attr('value');
					$(this).removeClass("seatSelected");
					$(".seatList ." + thisName).remove();
				}
			} else {
				if (!$(this).hasClass("seatDisable")) {
					if ($(this).hasClass("seatSelected")) {
						var thisName = $(this).attr('value');
						$(this).removeClass("seatSelected");
						$(".seatList ." + thisName).remove();
					} else {
						$(this).addClass("seatSelected");
						var thisName = $(this).attr('value');
						$(".seatList").append('<span class=' + thisName + '>' + thisName + "&nbsp;," + '</span>');
					}
				}
			}
		});

		$(".btnClear").click(function() {
			$(".seatSelected").removeClass("seatSelected");
			$(".seatList span").remove();
		});

		$(".combo").change(function() {
			var slcombo=$(this).val();
			var combo=$(this).attr('id');
			var combo=combo.split("-");
			if (slcombo >= 1) {
				if (slcombo > 1) {
					$(".comboList ."+ combo[1]).remove();
					$(".comboList").append('<span class='+ combo[1] +'>'+ combo[0] +'(x'+ slcombo +')&nbsp;,'+'</span>');
				}else{
					$(".comboList ."+ combo[1]).remove();
					$(".comboList").append('<span class='+ combo[1] +'>'+ combo[0] +'(x'+ slcombo +')&nbsp;,'+'</span>');
				}
			}else{
				$(".comboList ."+ combo[1]).remove();
			}
		});

		$(".tt").click(function(){
			if ($("#Numseats").val() == 0) {
				alert('Vui lòng chọn số lượng vé');
			}
			else{
				$('.booking').addClass('tieptuc');
				$('.seatbooking').addClass('showseat');
			}
		});
		var allseat=[];
		var allcombo=[];
		var soluongcb=[];
		var combo={
			id:null,
			sl:null
		};
		$(".datve").click(function() {
			// Lấy thông tin đặt vé
			let lichchieu_id = $(".idlich").val();
			let so_luong_ve = $("#Numseats").val();
			let tong_gia_ve = $("#total").text(); // Tổng giá vé
			let combo = []; // Mảng combo đã chọn
			let ghe = []; // Mảng ghế đã chọn

			// Lấy thông tin combo đã chọn
			$(".comboList span").each(function() {
				let text = $(this).text();
				combo.push(text);
			});

			// Lấy thông tin ghế đã chọn
			$(".seatList span").each(function() {
				let text = $(this).text();
				ghe.push(text);
			});

			// Gửi dữ liệu đến server
			$.ajax({
				url: "{{ route('booking.store') }}",
				type: "POST",
				data: {
					lichchieu_id: lichchieu_id,
					so_luong_ve: so_luong_ve,
					tong_gia_ve: tong_gia_ve,
					combo: combo,
					ghe: ghe,
					_token: '{{ csrf_token() }}'  // CSRF Token bắt buộc trong Laravel
				},
				success: function(response) {
					alert(response.message);
					$('#confirmModal').modal('hide');
					
					// Chuyển hướng về trang chủ
					window.location.href = response.redirect;
					// Xử lý khác nếu cần
				},
				error: function(xhr) {
					if (xhr.status === 401) {
						alert(xhr.responseJSON.message); // Nếu người dùng chưa đăng nhập
					} else {
						alert('Đặt vé không thành công, vui lòng thử lại.');
					}
				}
			});
		});

	});
		var giave=document.getElementById('giave').innerHTML;
		var slve=document.getElementsByClassName('slve');
		var tongtienve=document.getElementsByClassName('tongtienve');
		var prices = [65000,80000,150000];
		var units = document.getElementsByClassName('units-class');
		var subs = document.getElementsByClassName('subtotal-class');
		var grand = document.getElementById('total');
	tienve();
		var tongtv=0;
		function tienve(){
			for(i = 0; i < tongtienve.length; i++){
				tongtv=slve[i].value * giave;
				tongtienve[i].innerHTML=tongtv;
			}
			grand.innerHTML = tongtv;
		}
	calculate();

		function calculate(){
			let sum = 0;
			for(i = 0; i < subs.length; i++){
				var subTotal = units[i].value * prices[i];
				subs[i].innerHTML = subTotal;
				sum += subTotal;
			}

			grand.innerHTML = sum+tongtv; 
		}
</script>
@endsection