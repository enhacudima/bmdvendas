<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mesa;
use App\Entradas;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Post::class, 'post');
       // $this->middleware('can:browse_menus');


    }



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mesa=Mesa::where('screen',1)->join('users','mesa.idusuario','users.id')->select('users.name as username','mesa.name','mesa.description','mesa.status','mesa.updated_at','mesa.created_at','mesa.id')->get();

        return view('home',compact('mesa'));
    }
}
