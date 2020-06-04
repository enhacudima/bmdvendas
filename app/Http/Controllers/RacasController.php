<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especies;
use App\Racas;
use App\Pelagem;
use Auth;

class RacasController extends Controller
{
    
    
        public function __construct()
    {

        return Auth::guard(app('VoyagerGuard'));
    }
    
    public function index ()
    {
        $this->authorize('racas');

    	$especies = Especies::get();
    	$racas = Racas::join('especies','especies.id','racas.especies_id')->select('racas.*','especies.nome as nome_especie')
    	->get();
    	return view('admin.racas.index',compact('especies','racas'));
    }

    public function especie_store(Request $request)
    {
            $this->authorize('store_especie');

    	    $this->validate($request, [
    	    	'nome'=>'required|min:3|unique:especies|max:255',
    	    	'user_id'=>'required',
    	    ]);
    	    Especies::create($request->all());

    	return back()->with('success','Successfully Added to List');
    }


    public function raca_store(Request $request)
    {
            $this->authorize('store_racas');

    	    $this->validate($request, [
    	    	'nome'=>'required|min:3|unique:racas|max:255',
    	    	'user_id'=>'required',
    	    	'especies_id'=>'required',
    	    ]);
    	    Racas::create($request->all());

    	return back()->with('success','Successfully Added to List');
    }


    public function pelagem_store(Request $request)
    {
            $this->authorize('store_pelagem');
    	    $this->validate($request, [
    	    	'nome'=>'required|min:3|unique:pelagem|max:255',
    	    	'user_id'=>'required',
    	    ]);
    	    Pelagem::create($request->all());

    	return back()->with('success','Successfully Added to List');
    }
}
