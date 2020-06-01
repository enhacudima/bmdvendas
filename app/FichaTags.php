<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaTags extends Model
{
    protected $table = 'ficha_clinica_tags';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;


    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
        public function tag()
    {
        return $this->belongsTo(Tags::class,'tags_id','id');
    }
}
