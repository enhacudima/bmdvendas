<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\CarTemp;
use App\VendasTempMesa;

class CarController extends Controller
{
    
        public function __construct()
    {
        $this->middleware('auth');


    }

    public function carindex ($id)
    {

    	$mesa_id=$id;
    	$car=Car::get();
    	$car_temp=CarTemp::where('car_mesa',$mesa_id)->join('car','car_temp.car_id','car.id')->select('car_temp.*','car.matricula','car.name','car.sname','car.contacto1','car.contacto2','car.marca')->get();
    

    	return view('admin.car.index',compact('mesa_id','car','car_temp'));
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
           return back()->with('error','Não pode duplicar o carro existente na lista de espera'); 
    	}else{

    	CarTemp::create([

    	'user_id'=>$user_id,
    	'car_id'=>$id,
    	'car_mesa'=>$mesa_id,
    	]);	
    	}


    

    	return back()->with('success','Carro adicionado com sucesso na lista de espera');

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
}
