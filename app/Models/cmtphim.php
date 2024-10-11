<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cmtphim extends Model
{
    protected $table='cmtphim';
    public $timestamps=true;

    public function phim()
    {
    	return $this->belongsTo('App\Models\phim','id_phim','id');
    }
    public function user()
    {
    	return $this->belongsTo('App\Models\User','id_user','id');
    }

}
