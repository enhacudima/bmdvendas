<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;


    public function vendas()
    {
        return $this->hasMany('App\ClienteVenda', 'cliente_id', 'id');
    }

}
