<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes=Cliente::get();
        $pacientes=Paciente::get();
        $especies = DB::table('especies')->get();
        $racas = DB::table('racas')->get();
        return view('admin.paciente.index',compact(['pacientes','clientes','especies','racas']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nome'=>'required|min:3|max:50|string',
            'user_id'=>'required',
            'cliente_id'=>'required',
            'especie'=> 'required|string',
            'raca'=>'required',
            'sexo'=>'required',
            'idade'=>'required',
            'pelagem'=>'required|string',
        ]);


        Paciente::create($data);

        return back()->with('success','Successfully Added to List');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paciente=Paciente::find($id);
        $clientes=Cliente::get();
        $especies = DB::table('especies')->get();
        $racas = DB::table('racas')->get();

        return view('admin.paciente.show',compact(['paciente','clientes','especies','racas']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Paciente::find($id);
        $object = $request->validate([
            'nome'=>'required|min:3|max:50|string',
            'user_id'=>'required',
            'cliente_id'=>'required',
            'especie'=> 'required|string',
            'raca'=>'required',
            'sexo'=>'required',
            'idade'=>'required',
            'pelagem'=>'required|string',
        ]);



        $data->nome = $object['nome'];
        $data->cliente_id = $object['cliente_id'];
        $data->especie = $object['especie'];
        $data->raca = $object['raca'];
        $data->sexo = $object['sexo'];
        $data->idade = $object['idade'];
        $data->user_id = $object['user_id'];
        $data->save();

        return redirect()->route('paciente.index')->with('success','Successfully updated to List');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        //
    }
}
