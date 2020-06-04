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
                    @if(isset($report->sync_filtros[0]->filtros->value))
                    <select class="form-control" name="filtro">
                        @foreach($report->sync_filtros as $filtro)
                            <option value="{{$filtro->filtros->value}}">{{$filtro->filtros->name}}</option>
                        @endforeach
                    </select>
                    <br/>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                <input class="form-control"  type="date" name="start"  ></div>
                            </div>

                    
                            <div class="col-md-6">
                                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                <input class="form-control"  type="date" name="end"  ></div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <span >
                      <small class="label  bg-red">We recommend that you select an interval to avoid processing delay.</small>
                    </span>
                    @else
                        <div class="callout callout-info">
                            <h4>Filters</h4>

                            <p>Filters are not available for this report</p>
                        </div>
                        <input name="filtro" value="no_filter" type="hidden">
                    @endif
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
