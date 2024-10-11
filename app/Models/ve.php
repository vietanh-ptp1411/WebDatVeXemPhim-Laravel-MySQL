<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ve extends Model
{
    use HasFactory;

    protected $table = 've'; 
    protected $fillable = [
        'id_lichchieu',
        'id_ghe',
        'id_user',
        // Các trường khác nếu có
    ];

    public function lichchieu()
    {
    	return $this->belongsTo('App\Models\lichchieu','id_lichchieu','id');
    }
    public function ghe(){
    	return $this->belongsTo('App\Models\ghe','id_ghe','id');
    }
    public function user()
    {
    	return $this->belongsTo('App\Models\User','id_user','id');
    }
    public function vephim()
    {
        return $this->hasManyThrough('App\Models\phim', 'App\Models\lichchieu','id_phim','id_lichchieu','id');
    }
}
