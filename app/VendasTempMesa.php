<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendasTempMesa extends Model
{
    protected $table = 'vendas_temp_mesa';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;


    public function produtos()
    {
        return $this->belongsTo('App\Produtos', 'produto_id', 'id');
    }
}
