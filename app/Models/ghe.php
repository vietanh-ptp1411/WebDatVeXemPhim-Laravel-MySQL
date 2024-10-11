<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ghe extends Model
{
    protected $table='ghe';
    public $timstamps=-true;

    public function phong()
    {
    	return $this->belongsTo('App\Models\phong','id_phong','id');
    }
    public function datghe()
    {
    	return $this->hasOne('App\Models\datghe');
    }
    public function ve()
    {
        return $this->hasOne('App\Models\ve','id_ghe','id');
    }
}
