<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DataTables;
use DB;
use App\Email;
use App\Mail\Geral;
use App\Jobs\SendEmailGeral;
use Carbon\Carbon;
use App\ContactForm;
use Auth;

class EmailController extends Controller
{

      protected function guard()
  {
      return Auth::guard(app('VoyagerGuard'));
  }

      public function all()
      {
        $this->authorize('emails');
        $sent=Email::where('status',0)->count();
        $drafts=Email::where('status',1)->count();
        $inbox=ContactForm::where('read_or_not',1)->count();
       return view('email.emailAll', compact('sent','drafts','inbox'));
      }

      public function allsource()
      {
         $data=Email::select('emails_send.*','users.name')->join('users', 'emails_send.user_id', '=', 'users.id')->orderby('emails_send.created_at','desc');
         return Datatables::of($data)
                ->addColumn('assuntox','{{$assunto}} - {{$name_cliente}}')
                ->addColumn('time', '{{\Carbon\Carbon::parse($created_at)->diffForHumans()}}')
                ->make(true);
      }

      public function inbox()
      {
        $sent=Email::where('status',0)->count();
        $drafts=Email::where('status',1)->count();
        $inbox=ContactForm::where('read_or_not',1)->count();

        return view('email.inbox', compact('sent','drafts','inbox'));
      }
      public function inboxData ()
      {
        $data=ContactForm::select('*')->orderby('created_at');
        return Datatables::of($data)
              ->addColumn('time','{{\Carbon\Carbon::parse($created_at)->diffForHumans()}}')
              ->make(true);

      }

    public function index()
    {


    $this->authorize('emails');

      $sent=Email::where('status',0)->count();
      $drafts=Email::where('status',1)->count();
      $inbox=ContactForm::where('read_or_not',1)->count();
        
        return view('email.email', compact('sent','drafts','inbox'));
    }

    public function enviaremail(Request $request)
    {
    $this->authorize('emails');
        $data=$request->all();
        $this->validate($request, array(
            'message' => 'required|min:3',
            'assunto' => 'required|min:3',
        ));

        $id=Email::create($data);
        $id=$id->id;

        //Mail::to($data['to'])->send(new Geral($data));

        $emailJob = (new SendEmailGeral($data,$id));
        dispatch($emailJob);
        
        return back()->with('success','Email enviado');
    }

        public function try($id)
    {
   $this->authorize('emails');

        $data=Email::find($id)->toArray();

        $emailJob = (new SendEmailGeral($data,$id));
        dispatch($emailJob);
        
        return back()->with('success','Email enviado');
    }

    public function read ($id)
    {
         $this->authorize('emails');

      $data=ContactForm::find($id);
      if ($data->read_or_not==0) {
          $data->read_or_not=1;
      }else{
          $data->read_or_not=0;
      }
     
      $data->save();

      return $this->inbox();

    }

    public function reply($id){
      
         $this->authorize('emails');

      $data=ContactForm::find($id);
      
      $sent=Email::where('status',0)->count();
      $drafts=Email::where('status',1)->count();
      $inbox=ContactForm::where('read_or_not',1)->count();
        
      return view('email.email_reply', compact('sent','drafts','inbox','data'));

    }
}
