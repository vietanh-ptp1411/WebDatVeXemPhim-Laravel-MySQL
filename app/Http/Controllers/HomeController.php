<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\slide;
use App\Models\phim;
use App\Models\User;
use App\Models\lichchieu;
use App\Models\combo;
use App\Models\datve;
use App\Models\cmtphim;
use App\Models\ghe;
use App\Models\datghe;
use App\Models\ve;
use App\Models\phong;
use App\Models\rap;
use App\Models\datcombo;
use App\Models\tintuc;
use App\Models\OrderVe;
use Illuminate\Support\collection;
 
class HomeController extends Controller
{
    public function trangchu()
    {   
        $slide=slide::limit(3)->get();
        $phimdc=phim::where('trangthai','1')->limit(4)->get();
        $phimsc=phim::where('trangthai','0')->limit(4)->get();
        $review=tintuc::where('theloai',1)->get();
        $blog=tintuc::where('theloai',0)->get();
        return view('trangchu',compact('slide','phimdc','phimsc','review','blog'));
    }
 
    public function search(Request $request)
    {
        $slide=slide::limit(3)->get();
        $review=tintuc::where('theloai',1)->get();
        $blog=tintuc::where('theloai',0)->get();
        // Lấy tất cả sản phẩm có status =1 ra và sắp xếp tăng dần
        $phim = DB::table('phim')->where('trangthai', '1')->orderby('id', 'asc')->get();
        //tìm từ khóa theo tên sản phẩm
        $keywords = $request->keywordsubmit;
        $search_phim = DB::table('phim')->where('tenphim', 'like', '%' . $keywords .  '%')->get();

        return view('search', compact('slide','phim', 'search_phim','review','blog'));
    }

    
    public function chitietphim($idphim)
    {
        // Lấy tiêu đề phim
        $tieude = phim::where('id', $idphim)->value('tenphim');
        
        // Lấy thông tin phim và các phim liên quan
        $phim = phim::where('id', $idphim)->first();
        $phimlq = phim::where('trangthai', '1')
            ->inRandomOrder()
            ->limit(3)
            ->get();

        // Lấy comment của phim
        $cmtphim = cmtphim::where('id_phim', $idphim)->get();

        // Lấy lịch chiếu theo rạp, ngày và phòng
        $lich = lichchieu::where('id_phim', $idphim)
            ->select('id_rap')
            ->distinct()
            ->get();

        foreach ($lich as $rap) {
            // Lấy các ngày chiếu trong rạp này
            $ngayChieu = lichchieu::where('id_phim', $idphim)
                ->where('id_rap', $rap->id_rap)
                ->select('ngay')
                ->distinct()
                ->get();

            foreach ($ngayChieu as $ngay) {
                // Lấy các phòng chiếu trong ngày này
                $phongChieu = lichchieu::where('id_phim', $idphim)
                    ->where('id_rap', $rap->id_rap)
                    ->where('ngay', $ngay->ngay)
                    ->select('id_phong')
                    ->distinct()
                    ->get();

                foreach ($phongChieu as $phong) {
                    // Lấy các thời gian chiếu trong phòng
                    $timeChieu = lichchieu::where('id_phim', $idphim)
                        ->where('id_rap', $rap->id_rap)
                        ->where('ngay', $ngay->ngay)
                        ->where('id_phong', $phong->id_phong)
                        ->get();

                    // Gán thời gian chiếu vào phòng chiếu
                    $phong->time = $timeChieu;
                }

                // Gán phòng chiếu vào ngày chiếu
                $ngay->id_phong = $phongChieu;
            }

            // Gán ngày chiếu vào rạp
            $rap->ngay = $ngayChieu;
        }

        // Trả dữ liệu ra view
        return view('phim', compact('tieude', 'phim', 'phimlq', 'lich', 'cmtphim'));
    }


    public function chitietdatve($id)
    {
        $lichchieu = lichchieu::where('id', $id)->get();
        $phim = phim::where('id',$id)->get();
        $cb = combo::all();
        foreach ($lichchieu as $lc) {
            $idp = $lc->id_phong;
        }

        // Sửa câu truy vấn để tránh lỗi ONLY_FULL_GROUP_BY
        $ghe = ghe::select('row', DB::raw('MAX(id) as id'))  // Lấy 'row' và MAX id
            ->where('id_phong', $idp)
            ->groupBy('row')
            ->get();

        for($i = 0; $i < count($ghe); $i++){
            $g = ghe::where([['id_phong', $idp], ['row', $ghe[$i]->row]])->get();
            $ghe[$i]['number'] = $g;
        }

        $ve = ve::where('id_lichchieu', $id)->get();
        return view('datve', compact('lichchieu', 'cb', 'ghe', 've','phim'));
    }


    public function review($id)
    {
        $review=tintuc::where([['id',$id],['theloai',1]])->get();
        return view('Review',compact('review'));
    }

    public function blog($id)
    {
        $blog=tintuc::where([['id',$id],['theloai',0]])->get();
        return view('blog',compact('blog'));
    }

    public function phimdangchieu()
    {
        $phimdc=phim::where('trangthai','1')->get();
        return view('phimdangchieu',compact('phimdc'));
    }
    public function phimsapchieu()
    {
        $phimsc=phim::where('trangthai','0')->get();
        return view('phimsapchieu',compact('phimsc'));
    }
    public function formdangnhap()
    {
        return view('.login.dangnhap');
    }
   

    public function getdangky()
    {
        return view('.login.dangky');
    }
    public function postdangky(Request $request)
    {
        $this->validate($request,[
            'pass'=>'required|min:3',
            'repass'=>'required|min:3|same:pass'
        ],[
            'repass.same'=>'Bạn chưa nhập lại mật khẩu'
        ]);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->pass);
        $user->save();
        return redirect('/');

    }
    public function dangxuat()
    {
        Auth::logout();
        return redirect('/');
    }
   

    public function datve(Request $req)
    {
        // Kiểm tra dữ liệu nhận được
        // dd($req->all());

        // Validate request
        $validated = $req->validate([
            'idlich' => 'required|integer|exists:lichchieu,id', // Thay 'lichchieus' bằng tên bảng chính xác
            'iduser' => 'required|integer|exists:users,id', // Thay 'users' bằng tên bảng người dùng
            'allseat' => 'required|array|min:1',
            'allseat.*' => 'integer|exists:ghe,id', // Thay 'ghe' bằng tên bảng ghế
            'allcombo' => 'sometimes|array',
            'allcombo.*.idcb' => 'required_with:allcombo|integer|exists:combos,id', // Thay 'combos' bằng tên bảng combo
            'allcombo.*.slcb' => 'required_with:allcombo|integer|min:1',
        ]);

        try {
            // Cập nhật thông tin vé
            $ghe = $req->allseat;
            foreach ($ghe as $id_ghe) { 
                $ve = Ve::where([
                    ['id_lichchieu', $req->idlich], 
                    ['id_ghe', $id_ghe]
                ])->first();

                if ($ve) {
                    if ($ve->id_user !== null) {
                        // Ghế đã được đặt
                        return response()->json(['error' => 'Một hoặc nhiều ghế đã được đặt trước đó.'], 409);
                    }
                    $ve->update(['id_user' => $req->iduser]);
                } else {
                    return response()->json(['error' => 'Ghế không tồn tại.'], 404);
                }
            }

            // Thêm thông tin combo nếu có
            if ($req->has('allcombo')) {
                $combo = $req->allcombo;
                foreach ($combo as $item) { 
                    $cb = new Datcombo;
                    $cb->id_lichchieu = $req->idlich;
                    $cb->id_user = $req->iduser;
                    $cb->id_combo = $item['idcb'];
                    $cb->soluong = $item['slcb'];
                    $cb->save();
                }
            }

            return response()->json(['success' => 'Đặt vé thành công'], 200);
        } catch (\Exception $e) {
            // Ghi lại lỗi trong log Laravel
            // \Log::error($e);
            return response()->json(['error' => 'Có lỗi xảy ra trong quá trình đặt vé'], 500);
        }
    }
    
    
   

    public function postcmt(Request $request,$id)
    {
        $cmt=new cmtphim;
        $cmt->id_phim=$id;
        $cmt->id_user=Auth::user()->id;
        $cmt->noidung=$request->noidungcmt;
        $cmt->save();

        return redirect()->back();
    }
}
