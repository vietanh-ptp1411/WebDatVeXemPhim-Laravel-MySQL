<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class phong extends Model
{
    protected $table='phong';
    public $timestamps=true;

    public function lichchieu()
    {
    	return $this->hasMany('App\Models\lichchieu','id_phong','id');
    }
}
