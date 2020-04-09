<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\ProcessedFiles;
use DB;
use Carbon\Carbon;
use App\Exports\RelatorioExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\NotifyUserOfCompletedExport;
use File;
use App\ReportNew;


class ReportExtratController extends Controller
{
          protected function guard()
  {
      return Auth::guard(app('VoyagerGuard'));
  }

  public function index()
  {
    if (Auth::user()->can('view_all_files'))
    {
          $data=ProcessedFiles::select('processed_files.*','users.name','users.avatar')->join('users','processed_files.user_id','users.id')->orderby('processed_files.created_at','asc')->get();
    }else{
          $data=ProcessedFiles::select('processed_files.*','users.name','users.avatar')->where('users.id',Auth::user()->id)->join('users','processed_files.user_id','users.id')->orderby('processed_files.created_at','asc')->get();   
    }
  

    return view('admin.report.index',compact('data'));
  }

      public function deletefile($file)
    {
         $destinationPath = storage_path('app/');
         File::delete($destinationPath.$file);
         ProcessedFiles::where('filename',$file)->delete();

        return back();
    }

    public function alldeletefile()
    {
     $destinationPath = storage_path('app/');

        if (Auth::user()->can('view_all_files'))
    {
            $files=ProcessedFiles::get();
            $out='';

            foreach ($files as $file)
            {
            $out.=$file->filename.',';	
            }

               
             File::delete($destinationPath.$out);
             DB::delete('delete from processed_files');
    
    }

        return back();
    }


    public function new ()
    {   //$this->authorize('report');
        $data=ReportNew::get();
        return view('admin.report.new', compact('data'));
    }

    public function filtro(Request $request)
    {
    //$this->authorize('report');

        $request->validate([
            'start'=>'required|date',
            'end'=>'required|date|after:start'
        ]);


          $start=Carbon::parse($request->start);
          $end=Carbon::parse($request->end)->addHours(23)->addMinutes(59)->addSecond(59);
          $type=$request->type;
          $filtro=$request->filtro;

        $filename=$type.time().'.xlsx';
        $data=[];
        $data['filename']=$filename;
        $data['user_id']=Auth::user()->id;
        ProcessedFiles::create($data);

        //return Excel::download(new  RelatorioExport($start,$end,$type,$filtro), $filename);

        (new RelatorioExport($start,$end,$type,$filtro))->queue($filename)->chain([
            new NotifyUserOfCompletedExport(request()->user(),$filename),
        ]);

        return back()->withSuccess('Export started!');

    }
}
