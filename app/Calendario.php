<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{

    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
    

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
        public function paciente()
    {
        return $this->belongsTo('App\Paciente','paciente_id','id');
    }
}
