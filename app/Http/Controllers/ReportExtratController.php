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
    abort(403);
  }

        public function deletefile($file)
    {
        abort(403);
    }

    public function alldeletefile()
    {
        abort(403);
    }


    public function new ()
    {
        abort(403);
    }

    public function filtro(Request $request)
    {
        abort(403);

    }
}
