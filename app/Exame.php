<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exame extends Model
{
    protected $table = 'exame';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
