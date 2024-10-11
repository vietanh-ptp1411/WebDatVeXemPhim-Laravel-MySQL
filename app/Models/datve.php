<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class datve extends Model
{
    protected $table='datve';
    public $timestamps=true;
    public function lichchieu()
    {
    	return $this->belongsTo('App\Models\lichchieu','id_lichchieu','id');
    }
    public function user()
    {
    	return $this->belongsTo('App\Models\User','id_user','id');
    }
}
