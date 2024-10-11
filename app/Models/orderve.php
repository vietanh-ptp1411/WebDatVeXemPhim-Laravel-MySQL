<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrderVe extends Model
{
    protected $table = 'order_ve';

    protected $fillable = [
        'user_id',
        'lichchieu_id',
        'so_luong_ve',
        'tong_gia_ve',
        'combo',
        'ghe',
        'tong_tien'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function lichchieu()
    {
        return $this->belongsTo(lichchieu::class, 'lichchieu_id','id');
    }
}

