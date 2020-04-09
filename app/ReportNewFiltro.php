<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportNewFiltro extends Model
{
    protected $table = 'report_new_filtro';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true; 
}
