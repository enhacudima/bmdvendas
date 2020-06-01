<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especies extends Model
{
    protected $table = 'especies';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
