<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $table = 'contactform';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;
}
