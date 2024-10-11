<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderVe; // Đảm bảo bạn đã tạo model cho order_ve

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Kiểm tra nếu người dùng đã đăng nhập
            if (!auth()->check()) {
                return response()->json(['message' => 'Bạn cần đăng nhập để đặt vé.'], 401);
            }

            // Tạo order mới
            $order = new OrderVe();
            $order->user_id = auth()->user()->id;
            $order->lichchieu_id = $request->lichchieu_id;
            $order->so_luong_ve = $request->so_luong_ve;
            $order->tong_gia_ve = $request->tong_gia_ve;
            $order->combo = json_encode($request->combo); // Lưu combo dưới dạng JSON
            $order->ghe = json_encode($request->ghe); // Lưu ghế dưới dạng JSON
            $order->save();

            return response()->json([
                'message' => 'Đặt vé thành công!',
                'redirect' => url('/') // Đường dẫn trang chủ
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
