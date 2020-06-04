<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesa;
use Auth;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    
        public function __construct()
    {

        return Auth::guard(app('VoyagerGuard'));
    }

    
    public function index()
    {   
        $this->authorize('mesa');
        $mesas=Mesa::get();
        return view ('admin.mesa.index',compact('mesas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('mesa');
        $data=$request->all();
        $this->validate($request, [
            'name'=>'required|string|min:3|max:50|unique:mesa,name',
            'description'=>'required',
            ]);

        Mesa::create($data);

        return back()->with('success','Successfully Added to List');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $this->authorize('mesa');

        $mesa=Mesa::find($id);
       // dd($mesa);
        return view ('admin.mesa.show',compact('mesa'));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatemesa(Request $request)
    {    
        $this->authorize('mesa');
               
        $mesa=request()->except(['_token']);
        $this->validate($request, [
            'name'=>'required|string|min:3|max:50|unique:mesa,name',
            ]);
          
        Mesa::where('id',$mesa['id'])
                ->update($mesa);

        return $this->index()->with('success','Successfully Updated');        
    }
}
