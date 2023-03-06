<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClienteVenda extends Model
{
    protected $table = 'cliente_venda';
    protected $guarded =array();

    public $primaryKey = 'id';
    public $timestamps=true;


    public function caixa()
    {
        return $this->hasMany('App\VendasTempMesa', 'codigo_venda', 'codigo_venda');
    }

}
