<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datcombo extends Model
{
    use HasFactory;

    protected $table = 'datcombos'; // Thay 'datcombos' bằng tên bảng chính xác

    protected $fillable = [
        'id_lichchieu',
        'id_user',
        'id_combo',
        'soluong',
        // Các trường khác nếu có
    ];

    // Các quan hệ nếu có
}
