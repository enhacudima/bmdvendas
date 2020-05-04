<?php

namespace App\Http\Controllers;

use App\Calendario;
use Illuminate\Http\Request;
use App\Http\Requests\CalendarioRequest;
use App\Http\Controllers\Controller;
use MaddHatter\LaravelFullcalendar\Facades\Calendar; 
use Validator;


class CalendarioController extends Controller
{
      protected function guard()
  {
      return Auth::guard(app('VoyagerGuard'));
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     //$this->authorize('calendario');
        $calendarios = Calendario::get();
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

                    ]);

                     $calendario_list=[];

            }


        return view('calendario.index', compact('calendario_detalhes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addEvent(CalendarioRequest $request)
    {     //$this->authorize('calendario_create');
        Calendario::create($request->all());
        return $this->index()->with('success','Evento criado com sucesso.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function show($calendario)
    {
        //$this->authorize('calendario_create');
        $event = Calendario::find($calendario);  
        return view('calendario.edit', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$calendario)
    {
        //$this->authorize('calendario_create');
        $event = Calendario::find($calendario);
        $data=$request->except('_token');
        $event->titulo=$request->titulo;
        $event->cor=$request->cor;
        $event->data_inicio=$request->data_inicio;
        $event->data_final=$request->data_final;
        $event->concluido=$request->concluido;
        $event->paciente_id=$request->paciente_id;
        $event->save();


        return back()->with('success','Evento alterado com sucesso.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendario $calendario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Calendario  $calendario
     * @return \Illuminate\Http\Response
     */
    public function destroy($calendario)
    {
        //$this->authorize('calendario_create');
        $event = Calendario::find($calendario)->delete();
        return redirect('calendario')->with('success','Evento Elimidado com sucesso.');

    }
}
