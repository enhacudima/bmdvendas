<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportNewSyncFiltro extends Model
{
    protected $table = 'report_new_filtro_sync_group';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;


    public function filtros()
    {
        return $this->belongsTo('App\ReportNewFiltro','filtro','id');
    } 

}
