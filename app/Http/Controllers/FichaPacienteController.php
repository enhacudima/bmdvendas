<?php

namespace App\Http\Controllers;

use App\Anamnese;
use App\FichaPaciente;
use App\Paciente;
use Illuminate\Http\Request;
use App\Sinais_Clinicos;
use App\Exame;
use App\Diagnostico;
use App\Observacao;
use Auth;
use App\Peso;
use Carbon\Carbon;
use App\Charts\VendasLineChart;
use DB;
use App\Calendario;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class FichaPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //chart
        $labels=FichaPaciente::select(DB::raw('date_format(updated_at, "%Y-%m") as "date"'))
                        ->orderby('created_at','asc')
                        ->get()
                        ->groupBy('date')
                        ->map(function ($item) {
                              // Return the number of persons
                              return count($item);
                          });
          $total=FichaPaciente::select(DB::raw('date_format(created_at, "%Y-%m") as "date"'))
                        ->orderby('created_at','asc')
                        ->get()
                        ->groupBy('date')
                        ->map(function ($item) {
                              // Return the number of persons
                              return count($item);
                          });

         $aberto=FichaPaciente::select(DB::raw('date_format(updated_at, "%Y-%m") as "date"'))->where('status',0)
            ->orderby('created_at','asc')
            ->get()
            ->groupBy('date')
            ->map(function ($item) {
                  // Return the number of persons
                  return count($item);
              }); 
              
          $internamento=FichaPaciente::select(DB::raw('date_format(updated_at, "%Y-%m") as "date"'))->where('status',1)
                        ->orderby('created_at','asc')
                        ->get()
                        ->groupBy('date')
                        ->map(function ($item) {
                              // Return the number of persons
                              return count($item);
                          });

         $alta=FichaPaciente::select(DB::raw('date_format(updated_at, "%Y-%m") as "date"'))->where('status',2)
            ->orderby('created_at','asc')
            ->get()
            ->groupBy('date')
            ->map(function ($item) {
                  // Return the number of persons
                  return count($item);
              });

          $obto=FichaPaciente::select(DB::raw('date_format(updated_at, "%Y-%m") as "date"'))->where('status',3)
                        ->orderby('created_at','asc')
                        ->get()
                        ->groupBy('date')
                        ->map(function ($item) {
                              // Return the number of persons
                              return count($item);
                          });

            

          $graf = new VendasLineChart;
          $graf->labels($labels->keys());
          $graf->title('Performace das Consultas');
          $graf->dataset('Aberto', 'line', $aberto->values())->options([
                    'fill' => 'true',
                    'borderColor' => '#5160c1'
                ]);
          $graf->dataset('Internamento', 'line', $internamento->values())->options([
                    'fill' => 'true',
                    'borderColor' => '#51C1C0'
                ]);
          $graf->dataset('Alta', 'line', $alta->values())->options([
                    'fill' => 'true',
                    'borderColor' => '#51c17a'
                ]);
          $graf->dataset('Óbto', 'line', $obto->values())->options([
                    'fill' => 'true',
                    'borderColor' => '#c15151'
                ]);
          $graf->dataset('Total', 'line', $total->values())->options([
                    'fill' => 'true',
                    'borderColor' => '#4a5251'
                ]);
        //Endchart

        //agenda
        $calendarios = Calendario::all()->where('concluido',null);
            $calendario_list = [];
            $calendario_detalhes = [];
            foreach ($calendarios as $key => $calendario) {
                $line=$calendario->titulo.' '.$calendario->paciente['nome'].' '.$calendario->paciente['caderneta'].' '.$calendario->paciente['numero_ficha'];
                $calendario_list[]= Calendar::event(
                 $line,
                 true,
                 new \DateTime($calendario->data_inicio),
                 new \DateTime($calendario->data_final. '+1 day')
                );
            $calendario_detalhes=Calendar::addEvents($calendario_list,[
                        'color' => $calendario->cor,
                        'url' => 'calendario/detalhes/'.$calendario->id, 

                    ])
                    ->setOptions(['defaultView' => 'agendaDay']);

                     $calendario_list=[];

            }

        //Endagenda

        $fichas_clinicas = FichaPaciente::where('parent_id',null)->get();  
        $car=Paciente::get();
        dd($car[0]->cliente);
        $counta_ficha=FichaPaciente::orderby('updated_at','desc')->get();
        return view('admin.ficha_clinica.index',compact(['fichas_clinicas','counta_ficha','graf','calendario_detalhes']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ficha_clinica.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        
        $this->validate($request, [
            'paciente_id'=>'required',
        ]);


        if($data['anamnese']){
            $anamnese=$this->anamnese($data,$request);  
        };
        


        if($data['sinais_clinicos']){
            $sinais_clinicos=$this->sinais_clinicos($data,$request); 
        };


        if($data['exame_clinico']){

            $exame=$this->exame($data,$request);
        };
        if(isset($data['diagnostico']) or  isset($data['tratamento'])){

        $diagnostico_data=$this->diagnostico_data($data,$request);

        };

        if($data['peso']){
        $peso=$this->peso($data,$request);
        };

        if($data['observacao']){
        $observacao=$this->observacao($data,$request);
        };

        if (!isset($anamnese)) {
            $anamnese=null;
        }else{
            $anamnese=$anamnese->id;
        }

        if (!isset($sinais_clinicos)) {
            $sinais_clinicos=null;
        }else{
            $sinais_clinicos=$sinais_clinicos->id;
        }

        if (!isset($exame)) {
            $exame=null;
        }else{
            $exame=$exame->id;
        }
        if (!isset($observacao)) {
            $observacao=null;
        }else{
            $observacao=$observacao->id;
        }
        if (!isset($diagnostico_data)) {
            $diagnostico_data=null;
        }else{
            $diagnostico_data=$diagnostico_data->id;
        }
        if (!isset($peso)) {
            $peso=null;
        }else{
            $peso=$peso->id;
        }
        if(isset($request->parent_id)){
            $parent_id=$request->parent_id;
        }else{
            $parent_id=null;

            $verif=FichaPaciente::where('paciente_id',$data['paciente_id'])->where('parent_id',null)->first();
                if(isset($verif)){
                    $parent_id=$verif->id;
                }
        }


        FichaPaciente::create([
            'anamnese_id'=>$anamnese,
            'sinais_clinicos_id'=>$sinais_clinicos,
            'exame_id'=>$exame,
            'observacao_id'=>$observacao,
            'diagnostico_id'=>$diagnostico_data,
            'user_id'=>Auth::user()->id,
            'peso_id'=>$peso,
            'paciente_id'=>$data['paciente_id'],
            'parent_id'=>$parent_id
        ]);

        return back()->with('success','Successfully Added to List');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FichaPaciente  $FichaPaciente
     * @return \Illuminate\Http\Response
     */
    function anamnese($data,$request){
        $this->validate($request, [
                'd_anamnese'=>'required',
                'anamnese'=>'required',
        ]);
        return   $anamnese=Anamnese::create([
                'paciente_id' => $data['paciente_id'],
                'data' => $data['d_anamnese'],
                'anamnese' => $data['anamnese'],
                'user_id' => $data['user_id']
            ]);
    }

    function sinais_clinicos ($data,$request){
        $this->validate($request, [
                'd_sinais_clinicos'=>'required',
                'sinais_clinicos'=>'required',
            ]);
        return  $sinais_clinicos=Sinais_Clinicos::create([
                'paciente_id' => $data['paciente_id'],
                'data' => $data['d_sinais_clinicos'],
                'sinais_clinicos' => $data['sinais_clinicos'],
                'user_id' => $data['user_id']
            ]);
    }
    function exame ($data,$request){
        $this->validate($request, [
            'd_exame'=>'required',
            'exame_clinico'=>'required',
        ]);
        return  $exame=Exame::create([
                'paciente_id' => $data['paciente_id'],
                'data' => $data['d_exame'],
                'exame_clinico' => $data['exame_clinico'],
                'user_id' => $data['user_id']
            ]);
    }
    function diagnostico_data ($data,$request){
        $this->validate($request, [
            'd_diagnostico'=>'required',
        ]);
                        
        $diagnostico=null;
        $tratamento=null;

        if(isset($data['diagnostico']))
            {
                $diagnostico=$data['diagnostico'];
        };
        if(isset($data['tratamento']))
            {
                $tratamento=$data['tratamento'];
        };

        return
        $diagnostico_data=Diagnostico::create([
            'paciente_id' => $data['paciente_id'],
            'data' => $data['d_diagnostico'],
            'diagnostico' => $diagnostico,
            'tratamento' =>$tratamento,
            'user_id' => $data['user_id']
        ]);
    }
    function peso ($data,$request){
        $this->validate($request, [
            'd_peso'=>'required',
            'peso'=>'required',
        ]);
        return   $peso=Peso::create([
            'paciente_id' => $data['paciente_id'],
            'data' => $data['d_peso'],
            'peso' => $data['peso'],
            'user_id' => $data['user_id']
        ]);
    }

    function observacao ($data,$request){
        $this->validate($request, [
            'd_observacoes'=>'required',
            'observacao'=>'required',
        ]);

        return      $observacao=Observacao::create([
            'paciente_id' => $data['paciente_id'],
            'data' => $data['d_observacoes'],
            'observacao' => $data['observacao'],
            'user_id' => $data['user_id']
        ]);
    }

    public function show($FichaPaciente)
    {
        $ficha=FichaPaciente::find($FichaPaciente);

        if(isset($ficha->subFicha))
        {
            $sub_ficha = $ficha->subFicha()->orderby('created_at','desc')->paginate(5);
        };
        return view('admin.ficha_clinica.show',compact('ficha','sub_ficha'));
    }

    public function seguimento($id)
    {
        $ficha=FichaPaciente::find($id);
        return view('admin.ficha_clinica.create',compact(['ficha']));
    }
    public function altera_estado(Request $request)
    {   
        $this->validate($request, [
            'id'=>'required',
            'status'=>'required',
        ]);

        $ficha=FichaPaciente::find($request->id);
        if ($request->status==1) {
            $ficha->internamento_in=Carbon::Now();
        }
        if($request->status==2){
            $ficha->internamento_out=Carbon::Now();
        }
        $ficha->status=$request->status;
        $ficha->save();

        return back()->with('success','Atualizado com sucesso');
    }
    public function paciente_nova_ficha ($id)
    {
        $paciente=Paciente::find($id);

        return view('admin.ficha_clinica.create',compact(['paciente']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FichaPaciente  $FichaPaciente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ficha=FichaPaciente::find($id);

        return view('admin.ficha_clinica.edit',compact(['ficha']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FichaPaciente  $FichaPaciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {    
        $this->validate($request, [
            'paciente_id'=>'required',
        ]);

        $ficha=FichaPaciente::find($id);
        if ($ficha->status!=0 and $ficha->status!=1 ) {
            return back()->with('error','Não pode atualizar uma Ficha terminada');
        }
        $anamnese=Anamnese::find($ficha->anamnese_id);
        $sinais_clinicos=Sinais_Clinicos::find($ficha->sinais_clinicos_id);
        $exame=Exame::find($ficha->exame_id);
        $diagnostico_data=Diagnostico::find($ficha->diagnostico_id);
        $peso=Peso::find($ficha->peso_id);
        $observacao=Observacao::find($ficha->observacao_id);


        $data=$request->all();
        
        $this->validate($request, [
            'paciente_id'=>'required',
        ]);


        if($anamnese){
            $this->validate($request, [
                //'d_anamnese'=>'required',
                'anamnese'=>'required',
            ]);
            $anamnese->update([
                //'paciente_id' => $data['paciente_id'],
                //'data' => $data['d_anamnese'],
                'anamnese' => $data['anamnese'],
                'user_id' => $data['user_id']
            ]);   
        };
        

        if($sinais_clinicos){
            $this->validate($request, [
                //'d_sinais_clinicos'=>'required',
                'sinais_clinicos'=>'required',
            ]);
            $sinais_clinicos->Update([
                //'paciente_id' => $data['paciente_id'],
                //'data' => $data['d_sinais_clinicos'],
                'sinais_clinicos' => $data['sinais_clinicos'],
                'user_id' => $data['user_id']
            ]);    
        };


        if($exame){
            $this->validate($request, [
                //'d_exame'=>'required',
                'exame_clinico'=>'required',
            ]);
            $exame->Update([
                //'paciente_id' => $data['paciente_id'],
                //'data' => $data['d_exame'],
                'exame_clinico' => $data['exame_clinico'],
                'user_id' => $data['user_id']
            ]);
        };

        $diagnostico='';
        $tratamento='';

        if($diagnostico_data){
            if(isset($data['diagnostico']))
                {
                    $diagnostico=$data['diagnostico'];
            };
            if(isset($data['tratamento']))
                {
                    $tratamento=$data['tratamento'];
            };
        };

        $diagnostico_data->Update([
            //'paciente_id' => $data['paciente_id'],
            //'data' => $data['d_diagnostico'],
            'diagnostico' => $diagnostico,
            'tratamento' =>$tratamento,
            'user_id' => $data['user_id']
        ]);
        
        if($peso){
        $this->validate($request, [
            //'d_peso'=>'required',
            'peso'=>'required',
        ]);
        $peso->Update([
            //'paciente_id' => $data['paciente_id'],
            //'data' => $data['d_peso'],
            'peso' => $data['peso'],
            'user_id' => $data['user_id']
        ]);
        };

        if($observacao){
            $this->validate($request, [
                //'d_observacoes'=>'required',
                'observacao'=>'required',
            ]);
            $observacao->Update([
                //'paciente_id' => $data['paciente_id'],
                //'data' => $data['d_observacoes'],
                'observacao' => $data['observacao'],
                'user_id' => $data['user_id']
            ]);
        };


        //tying to insert
        if($data['anamnese'] and !isset($anamnese)){
            $anamnese=$this->anamnese($data,$request);  
        };
        
        if($data['sinais_clinicos'] and !isset($sinais_clinicos)){
            $sinais_clinicos=$this->sinais_clinicos($data,$request); 
        };


        if($data['exame_clinico'] and !isset($xame)){

            $exame=$this->exame($data,$request);
        };
        if((isset($data['diagnostico']) or  isset($data['tratamento'])) and !isset($diagnostico_data)){

            $diagnostico_data=$this->diagnostico_data($data,$request);

        };

        if($data['peso'] and !isset($peso)){
            $peso=$this->peso($data,$request);
        };

        if($data['observacao'] and !isset($observacao)){
            $observacao=$this->observacao($data,$request);
        };
        //end


        if (!isset($anamnese)) {
            $anamnese=null;
        }else{
            $anamnese=$anamnese->id;
        }

        if (!isset($sinais_clinicos)) {
            $sinais_clinicos=null;
        }else{
            $sinais_clinicos=$sinais_clinicos->id;
        }

        if (!isset($exame)) {
            $exame=null;
        }else{
            $exame=$exame->id;
        }
        if (!isset($observacao)) {
            $observacao=null;
        }else{
            $observacao=$observacao->id;
        }
        if (!isset($diagnostico_data)) {
            $diagnostico_data=null;
        }else{
            $diagnostico_data=$diagnostico_data->id;
        }
        if (!isset($peso)) {
            $peso=null;
        }else{
            $peso=$peso->id;
        }


        $ficha->Update([
            'anamnese_id'=>$anamnese,
            'sinais_clinicos_id'=>$sinais_clinicos,
            'exame_id'=>$exame,
            'observacao_id'=>$observacao,
            'diagnostico_id'=>$diagnostico_data,
            'user_id'=>Auth::user()->id,
            'peso_id'=>$peso,
            'paciente_id'=>$data['paciente_id'],
        ]);

        return back()->with('success','Atualizado com sucesso');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FichaPaciente  $FichaPaciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(FichaPaciente $FichaPaciente)
    {
        //
    }
}
