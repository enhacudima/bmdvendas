<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\CarTemp;
use App\VendasTempMesa;
use App\Mesa;
use App\Paciente;
use Auth;
use App\Entradas;
use DB;

class CarController extends Controller
{
    
        public function __construct()
    {
        $this->middleware('auth');


    }

    public function carindex ($id)
    {

    	$mesa_id=$id;
    	//$car=Car::get();
        $car=Paciente::get();
    	$car_temp=CarTemp::where('car_mesa',$mesa_id)
                    ->get();
        $mesa=Mesa::find($id); 
        $mesas=Mesa::where('description','!=','banho')
                    ->where('description','!=','consultorio')
                    ->get(); 
        $tipo_banho=DB::table('produtos_venda_view')->where('status',1)
                                                    ->where('produto_status',1)
                                                    ->where('id',38)
                                                    ->orwhere('id',37)
                                                    ->get();

    	return view('admin.car.index',compact('mesas','mesa','mesa_id','car','car_temp','tipo_banho'));
    }
    public function carcreate($id)
    {	$mesa_id=$id;
    	return view('admin.car.create',compact('mesa_id'));
    }
    public function storcar(Request $request)
    {
    	$data=$request->all();
    	$this->validate($request, [
            'name'=>'required|min:3|max:50|string',
            'user_id'=>'required',
            'sname'=>'required|min:3|max:50|string',
            'matricula'=> 'required|min:5|max:10|string|unique:car',
            'marca'=>'required|min:3|max:50|string|',
            'modelo'=>'required|min:3|max:50|string',
            'contacto1'=>'required|min:9|max:9',
            'contacto2'=>'max:9',
            ]);


    	Car::create($data);

        return back()->with('success','Successfully Added to List');
    }

    public function carshow($id,$mesa_id)
    {
    	$car=Car::find($id);

    	return view('admin.car.show', compact('car','mesa_id','id'));
    }

        public function atualizar(Request $request)
    {
    	$data=$request->all();
    	$this->validate($request, [
            'name'=>'required|min:3|max:50|string',
            'user_id'=>'required',
            'sname'=>'required|min:3|max:50|string',
            'matricula'=> 'required|min:5|max:10|string',
            'marca'=>'required|min:3|max:50|string|',
            'modelo'=>'required|min:3|max:50|string',
            'Contacto1'=>'required|min:9|max:9',
            'Contacto2'=>'max:9',
            ]);


    	$car=Car::find($data['id']);

    	$car->update($data);

        return redirect(url('carindex',$data['id']))->with('success','Successfully Updated on List');
    }


    	public function cartemp($id, $mesa_id,$user_id)
    {	
    	$car=CarTemp::where('car_id',$id)->get();
    	if ($car->first()) {
           return back()->with('error','Não pode duplicar um elemento existente na lista de espera'); 
    	}else{

    	CarTemp::create([

    	'user_id'=>$user_id,
    	'car_id'=>$id,
    	'car_mesa'=>$mesa_id,
    	]);	
    	}
    	return back()->with('success','Paciente adicionado com sucesso na lista de espera');

    }


     public function  carapagalinha(Request $request)
    {
      if($request->ajax())
        {
          $request->except('_token'); 
          $data=$request->all();

          $linha_id=$data['linha_id'];
          $mesa_id=$data['mesa_id'];
          $data_mesa=VendasTempMesa::where('mesa_id',$mesa_id)->whereNull('codigo_venda')->first();

          if (isset($data_mesa)) {
              $status=false;
          }else{
            CarTemp::where('id',$linha_id)->delete();
             $status=true;
          }

          

    
        return \Response::json($status);

          
        }
    }
    public function facturacao(Request $request)
    {
        $this->validate($request, [
            'tipo_banho'=>'required',
            'mesa_id'=>'required',
            'paciente'=>'required',
            'pacienteLinhaVenda'=>'required',
        ]);



        $produt_entrada_id=$request->tipo_banho;//defina o codigo da entrada
        $user_id = (!Auth::guest()) ? Auth::user()->id : null ;//user_id   
        $identificador_de_bulk='mesa'.'_'.time();

       $produtos=new VendasTempMesa();
        $produtos->user_id=$user_id;
        $produtos->produto_id=$produt_entrada_id;
        $produtos->quantidade=1;
        $produtos->identificador_de_bulk=$identificador_de_bulk;
        $produtos->mesa_id=$request->mesa_id;
        $produtos->car_id=$request->paciente;
        $produtos->save();

        $mesa=Mesa::find($request->mesa_id);
        $mesa->status=0;
        $mesa->idusuario=Auth::user()->id;
        $mesa->save();

        CarTemp::where('id',$request->pacienteLinhaVenda)->delete();

         
    }
}
