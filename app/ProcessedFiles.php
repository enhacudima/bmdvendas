<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessedFiles extends Model
{
    protected $table = 'processed_files';
    protected $guarded =array();
    //protected $casts = ['data' => 'array'];
    public $primaryKey = 'id';

    public $timestamps=true;
}
