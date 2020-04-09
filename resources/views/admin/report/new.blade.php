@extends('adminlte::page')

@section('title',' | New')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
@stop

@section('content')
        
    @foreach($data as $report) 

        <div class="col-md-4">
          <div class="box box-default collapsed-box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{$report->name}}</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" method="POST" action="{{ url('report/filtro')}}" enctype="multipart/form-data">
                     @csrf
                    <input name="type" value="{{$report->table_name}}" type="hidden">
                    <select class="form-control" name="filtro">
                        @foreach($report->filtros as $filtro)
                            <option value="{{$filtro->value}}">{{$filtro->name}}</option>
                        @endforeach
                    </select>
                    <br/>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                <input class="form-control"  type="date" name="start" required autofocus ></div>
                            </div>

                    
                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                <input class="form-control"  type="date" name="end" required autofocus ></div>
                            </div>
                        </div>
                    </div>
                    <hr />
                <span class="input-group-btn">
                 <button type="submit" class="btn btn-primary btn-flat "><i class="fa fa-download"></i></button>
                </span>
                </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    @endforeach   

@stop
