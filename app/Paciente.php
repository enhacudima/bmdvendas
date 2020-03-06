<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'paciente';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
