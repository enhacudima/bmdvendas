<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{

    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
