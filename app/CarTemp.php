<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarTemp extends Model
{
    protected $table = 'car_temp';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;

     	public function paciente ()
 	{
 		return $this->belongsTo('App\Paciente','car_id','id');
 	}

}
