<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ReportNewFiltro;

class ReportNew extends Model
{
    protected $table = 'report_new';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;



        public function sync_filtros()
    {
        return $this->hasMany('App\ReportNewSyncFiltro','groupo_filtro','filtro');
    }  
}
