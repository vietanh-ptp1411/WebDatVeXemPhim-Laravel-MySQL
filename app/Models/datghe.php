<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datghe extends Model
{
    protected $table='datghe';
    public $timestamps=true;
    public function datve()
    {
    	return $this->belongsTo('App\Models\datve','id_datve','id');
    }
    public function ghe()
    {
    	return $this->belongsTo('App\Models\ghe','id_ghe','id');
    }
     public function lichchieu()
    {
    	return $this->belongsTo('App\Models\lichchieu','id_lichchieu','id');
    }
}
