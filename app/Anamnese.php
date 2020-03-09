<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anamnese extends Model
{
    protected $table = 'anamnese';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
