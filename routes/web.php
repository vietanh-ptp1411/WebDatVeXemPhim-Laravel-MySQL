<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::controller(App\Http\Controllers\HomeController::class)->group(function() {
    Route::get('', 'trangchu');
    Route::get('phim/{idphim}', 'chitietphim')->where(['idphim' => '[0-9]+']);
    Route::get('phimdangchieu', 'phimdangchieu');
    Route::get('phimsapchieu', 'phimsapchieu');
    Route::get('datve/{id}', 'chitietdatve');
    Route::get('review/{id}', 'review');
    Route::get('blog/{id}', 'blog');
    Route::get('dangnhap', 'formdangnhap');
    Route::post('login', 'dangnhap');
    Route::get('dangky', 'getdangky');
    Route::post('dangky', 'postdangky');
    Route::get('dangxuat', 'dangxuat');
    Route::get('xemlich', 'lich');
    Route::post('search', 'search')->name('search');
    Route::post('cmt/{id}', 'postcmt')->middleware('admin');
    Route::get('themghe', 'themghe');
});


Route::controller(App\Http\Controllers\BookingController::class)->group(function() {
    Route::post('/datve', 'store')->name('booking.store');
});




Route::controller(App\Http\Controllers\AdminController::class)->prefix('admin')->middleware('admin')->group(function() {
    Route::get('/', 'homeadmin');
    Route::get('qlyphim', 'Qlyphim');
    Route::get('qlytintuc', 'Qlytintuc');
    Route::get('qlyrap', 'Qlyrap');
    Route::get('qlylichchieu', 'lichchieu');
    Route::get('qlyphong', 'dsphong');
    Route::get('qlyghe', 'dsghe');
    Route::get('qlycombo', 'dscombo');
    Route::get('qlyuser', 'dsuser');
    Route::get('qlyve', 'dsve');
    Route::get('addphim', 'addphim');
    Route::post('formaddphim', 'addphimmoi');
    Route::get('updatephim/{id}', 'editphim');
    Route::post('formeditphim/{id}', 'validationphim');
    Route::get('xoaphim/{idphim}', 'xoap');
    Route::get('formtintuc', 'formtintuc');
    Route::post('addtintuc', 'addtintuc');
    Route::get('suatintuc/{idtt}', 'formsua');
    Route::post('suatintuc/{idtt}', 'suatt');
    Route::get('xoatintuc/{idtt}', 'xoatintuc');
    Route::get('addrap', 'addrap');
    Route::post('addrap', 'addmoirap');
    Route::get('xoarap/{id}', 'xoarap');
    Route::get('addlichchieu', 'formlich');
    Route::post('addlich', 'addlich');
    Route::get('sualichchieu/{idlc}', 'formsualich');
    Route::post('sualich/{idlc}', 'sualich');
    Route::get('xoalich/{id}', 'xoalichchieu');
    Route::get('addphong', 'formphong');
    Route::post('addphong', 'addphong');
    Route::get('xoaphong/{id}', 'xoaphong');
    Route::get('addcombo', 'formcombo');
    Route::post('addcombo', 'addcombo');
});

Route::get('ajax/ghe/{id}', [App\Http\Controllers\AdminController::class, 'showghe']);
Route::get('ajax/lichchieu/{id}', [App\Http\Controllers\AdminController::class, 'getlich']);
Route::get('ajax/phong/{id}', [App\Http\Controllers\AdminController::class, 'getphong']);

Route::get('lienket', function() {
    $lich = App\Models\ve::find(1)->lichchieu->phim;
    return $lich;
});
