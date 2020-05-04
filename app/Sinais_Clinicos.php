<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sinais_Clinicos extends Model
{
    protected $table = 'sinais_clinicos';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
