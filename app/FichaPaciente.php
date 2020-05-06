<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaPaciente extends Model
{
    protected $table = 'ficha_clinica';
    protected $guarded =array();

    public $primaryKey = 'id';

    public $timestamps=true;

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function anamnese()
    {
        return $this->belongsTo('App\Anamnese','anamnese_id','id');
    }
    public function sinais_clinicos()
    {
        return $this->belongsTo('App\Sinais_Clinicos','sinais_clinicos_id','id');
    }
    public function exame()
    {
        return $this->belongsTo('App\Exame','exame_id','id');
    }
    public function diagnostico()
    {
        return $this->belongsTo('App\Diagnostico','diagnostico_id','id');
    }
    public function observacao()
    {
        return $this->belongsTo('App\Observacao','observacao_id','id');
    }
    public function peso()
    {
        return $this->belongsTo('App\Peso','peso_id','id');
    }
    public function paciente()
    {
        return $this->belongsTo('App\Paciente','paciente_id','id');
    }

    public function subFicha()
    {
      return $this->hasMany(FichaPaciente::class, 'parent_id');
    }

}
