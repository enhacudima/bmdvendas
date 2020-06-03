<?php

namespace App\Http\Controllers;

use App\ContactForm;
use Illuminate\Http\Request;
use Response;
use Auth;

class ContactFormController extends Controller
{
   

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for ContactFormeating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ContactFormeate()
    {
        //
    }

    /**
     * Store a newly ContactFormeated resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=ContactForm::create($request->all());
        if (!$data)
        {
          return Response('Algo correu errado na sua requisição');
        }

        return Response('OK');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactForm  $ContactForm
     * @return \Illuminate\Http\Response
     */
    public function show(ContactForm $ContactForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactForm  $ContactForm
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactForm $ContactForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactForm  $ContactForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactForm $ContactForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactForm  $ContactForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactForm $ContactForm)
    {
        //
    }
}
