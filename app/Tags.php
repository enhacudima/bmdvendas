<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Tags extends Model
{
	use Eloquence;

	protected $searchableColumns = ['name','type'];//find user by sofa

    protected $table = 'tags';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
