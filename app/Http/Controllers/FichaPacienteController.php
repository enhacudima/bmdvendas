<?php

namespace App\Http\Controllers;

use App\Anamnese;
use App\ficha_paciente;
use App\Paciente;
use Illuminate\Http\Request;

class FichaPacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $fichas_clinicas = ficha_paciente::get();;
        return view('admin.ficha_clinica.index',compact(['fichas_clinicas']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacientes = Paciente::all();
        return view('admin.ficha_clinica.create', compact('pacientes'));
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
        /*
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
*/

        if($data['anamnese'])
        Anamnese::create([
            'paciente_id' => $data['paciente_id'],
            'data' => $data['d_anamnese'],
            'anamnese' => $data['anamnese'],
            'user_id' => $data['user_id']
        ]);

        return back()->with('success','Successfully Added to List');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ficha_paciente  $ficha_paciente
     * @return \Illuminate\Http\Response
     */
    public function show(ficha_paciente $ficha_paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ficha_paciente  $ficha_paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(ficha_paciente $ficha_paciente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ficha_paciente  $ficha_paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ficha_paciente $ficha_paciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ficha_paciente  $ficha_paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(ficha_paciente $ficha_paciente)
    {
        //
    }
}
