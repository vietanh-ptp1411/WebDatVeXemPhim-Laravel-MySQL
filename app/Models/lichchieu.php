<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lichchieu extends Model
{
    protected $table='lichchieu';
    public $timestamps=true;

    public function phim()
    {
    	return $this->belongsTo('App\Models\phim','id_phim','id');
    }
    public function rap()
    {
    	return $this->belongsTo('App\Models\rap','id_rap','id');
    }
    public function ve()
    {
        return $this->hasMany('App\Models\ve');
    }
    public function phong()
    {
        return $this->belongsTo('App\Models\phong','id_phong','id');
    }
}
