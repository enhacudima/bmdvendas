<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportNewFiltroGroupo extends Model
{
    protected $table = 'report_new_filtro_group';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;


    public function sync_filtros()
    {
        return $this->belongsTo('App\ReportNewSyncFiltro','filtro','id');
    } 

}
