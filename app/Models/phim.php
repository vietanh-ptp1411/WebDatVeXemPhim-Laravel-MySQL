<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phim extends Model
{
    protected $table='phim';
    public $timestamps = true;
    public function lich()
    {
    	return $this->hasMany('App\Models\lichchieu','id_phim','id');
    }
    public function cmtphim()
    {
    	return $this->hasMany('App\Models\cmtphim','id_phim','id');
    }
}

