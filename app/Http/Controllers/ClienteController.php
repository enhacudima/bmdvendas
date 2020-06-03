<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Auth;

class ClienteController extends Controller
{

    
        public function __construct()
    {

        return Auth::guard(app('VoyagerGuard'));
    }
    

    public function indexcliente()
    {
    	$this->authorize('cliente');
        $cliente=Cliente::get();
    	return view('admin.cliente.index',compact('cliente'));
    }

    public function clienteshow($id)
    {

        $this->authorize('show_cliente');

    	$client=Cliente::with('pacientes')->find($id);

    	return view('admin.cliente.show',compact('client'));
    }

        public function storcliente(Request $request)
    {

        $this->authorize('store_cliente');

    	$data=$request->all();
    	$this->validate($request, [
            'nome'=>'required|min:3|max:50|string',
            'user_id'=>'required',
            'apelido'=>'required|min:3|max:50|string',
            'endereco'=> 'required|min:5|max:255|string',
            'contacto1'=>'required|digits:9|unique:cliente',
            'contacto2'=>'nullable|digits:9',
            'email'=>'required|string|unique:cliente',
            'nuit'=>'required|digits:9'
            ]);


    	Cliente::create($data);

        return back()->with('success','Successfully Added to List');
    }
        public function updatecliente(Request $request)
    {	


        $this->authorize('update_cliente');
        
    	$data=$request->all();
    	$cliente=cliente::find($data['id']);

    	$newdata=$this->validate($request, [
            'nome'=>'required|min:3|max:50|string',
            'user_id'=>'required',
            'apelido'=>'required|min:3|max:50|string',
            'endereco'=> 'required|min:5|max:100|string',
            'contacto1'=>'required|digits:9',
            'contacto2'=>'nullable|digits:9',
            'email'=>'required|string',
            'nuit'=>'required|digits:9'
            ]);

    	$cliente->update($newdata);
    	

        return back()->with('success','Successfully updated recode');
    }


        public function searchcliente(Request $request)
    {   
         
        $this->authorize('search_cliente');


        $term = $request->get('search');
 
        if ( ! empty($term)) {
 
            // search loan  by loanid or nuit
            $clientes = Cliente::where('contacto1', 'LIKE', '%' . $term .'%')
                            ->orWhere('contacto2', 'LIKE', '%' . $term .'%')
                            ->orwhere('nome','LIKE','%'.$term.'%')
                            ->orwhere('apelido','LIKE','%'.$term.'%')
                            ->get();
 
            foreach ($clientes as $cliente) {
                $cliente->label   = $cliente->nome.' '.$cliente->apelido . ' (' . $cliente->contacto1 .')';
            }
 
            return $clientes;
        }
 
        return Response::json($clientes);
    }
}
