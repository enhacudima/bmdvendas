<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ficha_paciente extends Model
{
    protected $table = 'ficha_paciente';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
