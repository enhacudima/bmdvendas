<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{

	    public function __construct()
    {
        $this->middleware('auth');


    }
    

    public function indexcliente()
    {
    	$cliente=Cliente::get();
    	return view('admin.cliente.index',compact('cliente'));
    }

    public function clienteshow($id)
    {
    	$client=Cliente::find($id);

    	return view('admin.cliente.show',compact('client'));
    }

        public function storcliente(Request $request)
    {
    	$data=$request->all();
    	$this->validate($request, [
            'nome'=>'required|min:3|max:50|string',
            'user_id'=>'required',
            'apelido'=>'required|min:3|max:50|string',
            'endereco'=> 'required|min:5|max:255|string',
            'contacto1'=>'required|min:9|max:9|unique:cliente',
            'contacto2'=>'max:9',
            'email'=>'required|string|unique:cliente',
            ]);


    	Cliente::create($data);

        return back()->with('success','Successfully Added to List');
    }
        public function updatecliente(Request $request)
    {	
    	$data=$request->all();
    	$cliente=cliente::find($data['id']);

    	$newdata=$this->validate($request, [
            'nome'=>'required|min:3|max:50|string',
            'user_id'=>'required',
            'apelido'=>'required|min:3|max:50|string',
            'endereco'=> 'required|min:5|max:100|string',
            'contacto1'=>'required|min:9|max:9',
            'contacto2'=>'max:9',
            'email'=>'required|string',
            ]);

    	$cliente->update($newdata);
    	

        return back()->with('success','Successfully updated recode');
    }


        public function searchcliente(Request $request)
    {   
         


        $term = $request->get('search');
 
        if ( ! empty($term)) {
 
            // search loan  by loanid or nuit
            $clientes = Cliente::where('contacto1', 'LIKE', '%' . $term .'%')
            				->where('credito', 'sim')
                            ->orWhere('contacto2', 'LIKE', '%' . $term .'%')
                            ->orwhere('name','LIKE','%'.$term.'%')
                            ->get();
 
            foreach ($clientes as $cliente) {
                $cliente->label   = $cliente->name.' '.$cliente->sname . ' (' . $cliente->contacto1 .' & '.$cliente->contacto2. ')';
            }
 
            return $clientes;
        }
 
        return Response::json($clientes);
    }
}
