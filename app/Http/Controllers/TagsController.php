<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tags;
use Auth;

class TagsController extends Controller
{
    

        public function __construct()
    {

        return Auth::guard(app('VoyagerGuard'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('tag');

        $tags=Tags::get();
        return view('admin.tags.index', compact('tags'));
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
        $this->authorize('store_tag');

        $this->validate($request, [
            'name'=>'required|string|min:2|max:192',
            'type'=>'required|string|min:2|max:192',
            'description'=>'required|string|min:3',
            'user_id'=>'required'
        ]);

        Tags::create($request->all());

        return back()->with('success','Adicionado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('show_tag');
        $tags=Tags::find($id);
        return view('admin.tags.show',compact('tags'));
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
        $this->authorize('edit_tag');

        $data = Tags::find($id);
        $this->validate($request, [
            'name'=>'required|string|min:2|max:192',
            'type'=>'required|string|min:2|max:192',
            'description'=>'required|string|min:3',
            'user_id'=>'required'
        ]);

        $data->name=$request->name;
        $data->type=$request->type;
        $data->description=$request->description;
        $data->status=$request->status;
        $data->save();

        return redirect()->route('tags.index')->with('success','Successfully updated to List');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
