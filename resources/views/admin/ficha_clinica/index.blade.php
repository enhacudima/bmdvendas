@extends('adminlte::page')

@section('title', ' | Consultório')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('ficha-clinica') }}"><i class="fa fa-stethoscope"></i> Consultório</a></li>
        <li class="active">{{ Auth::user()->name }}</li>
    </ol>
    <style>
        .user_name{
            font-size:14px;
            font-weight: bold;
        }
        .comments-list .media{
            border-bottom: 1px dotted #ccc;
        }
    </style>
@stop

@section('content')
    <div class="row">
      <div class="col-md-3">

        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-stethoscope"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Abertos</span>
            <span class="info-box-number">{{$counta_ficha->where('status',0)->count()}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              @if(($counta_ficha->count())!=0)
              <div class="progress-bar" style="width: {{($counta_ficha->where('status',0)->count()/($counta_ficha->count()))*100}}%"></div>
              @endif
            </div>
            <span class="progress-description">
              @if(($counta_ficha->count())!=0)
              {{ number_format(($counta_ficha->where('status',0)->count()/($counta_ficha->count()))*100, 2) }}% 
              @endif
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>

      </div>

      <div class="col-md-3">
        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-heartbeat"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Internamento</span>
            <span class="info-box-number">{{$counta_ficha->where('status',1)->count()}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              @if(($counta_ficha->count())!=0)
              <div class="progress-bar" style="width: {{($counta_ficha->where('status',1)->count()/($counta_ficha->count()))*100}}%"></div>
              @endif
            </div>
            <span class="progress-description">
              @if(($counta_ficha->count())!=0)
              {{ number_format(($counta_ficha->where('status',1)->count()/($counta_ficha->count()))*100, 2) }}% 
              @endif
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>


      <div class="col-md-3">
        <div class="info-box bg-yellow">
          <span class="info-box-icon"><i class="fa fa-frown-o"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Óbto</span>
            <span class="info-box-number">{{$counta_ficha->where('status',3)->count()}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              @if(($counta_ficha->count())!=0)
              <div class="progress-bar" style="width: {{($counta_ficha->where('status',3)->count()/($counta_ficha->count()))*100}}%"></div>
              @endif
            </div>
            <span class="progress-description">
              @if(($counta_ficha->count())!=0)
              {{ number_format(($counta_ficha->where('status',3)->count()/($counta_ficha->count()))*100, 2) }}% 
              @endif
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>

        <div class="col-md-3">
        <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fa fa-paw"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Alta</span>
            <span class="info-box-number">{{$counta_ficha->where('status',2)->count()}}</span>
            <!-- The progress section is optional -->
            <div class="progress">
              @if(($counta_ficha->count())!=0)
              <div class="progress-bar" style="width: {{($counta_ficha->where('status',2)->count()/($counta_ficha->count()))*100}}%"></div>
              @endif
            </div>
            <span class="progress-description">
              @if(($counta_ficha->count())!=0)
              {{ number_format(($counta_ficha->where('status',2)->count()/($counta_ficha->count()))*100, 2) }}% 
              @endif
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="">

                <div class="panel-body">
                  <div>
                    {!! $graf->container()!!}
                  </div>  
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-8">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Últimas Consultas</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                @foreach($counta_ficha->take(11) as $ultima)
                @if(isset($ultima->paciente->nome))
                <li class="active"><a href="{{route('ficha-clinica.show',$ultima->id)}}"><i class="fa fa-stethoscope"></i> {{$ultima->paciente->nome}} - <i> {{$ultima->paciente->caderneta}}  {{$ultima->paciente->numero_ficha}} @</i>{{$ultima->user->name}} 
                <span class="text-muted pull-right">{{$ultima->updated_at->diffForHumans()}} - {{$ultima->updated_at->format('d/M/Y')}}</span>
                </a></li>
                @endif
                @endforeach
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <!-- /.box -->
        </div>

        <div class="col-md-4">
            <div class="box box-solid box-primary">
                <div class="box-header with-border"> <center><i class="fa fa-calendar"></i> Agenda</center></div>
                    <div class="box-body">
                      
                         {!! $calendario_detalhes->calendar()!!}
                      
                    </div>
            </div>
        </div>
    </div>


    <div class="panel panel-default">

    <div class="panel-heading">
        <div class="btn-group">
            <a href="{{route('ficha-clinica.create')}}" class="btn btn-primary">
                Novo fica clínica <i class="fa fa-stethoscope"></i>
            </a>
        </div>
        <div class="btn-group">
            <a href="{{url('calendario')}}" class="btn btn-primary">
                Nova marcação <i class="fa fa-calendar"></i>
            </a>
        </div>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">

    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Ficha cliníca</th>
                <th scope="col" width="150px">Time</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($fichas_clinicas))
            @foreach($fichas_clinicas as $fc)
            <tr>
                <td>{{$fc->id}}</td>
                <td>
                    <a href="{{route('ficha-clinica.show',$fc->id)}}">
                        <div class="media">
                            <div >
                                <div class="media-body" style="width: 40%;margin:20% " >
                                    @if(isset($fc->paciente->nome))
                                    <h4 class="media-heading user_name">Paciente: {{$fc->paciente->nome}}</h4>
                                    Caderneta: {{$fc->paciente->caderneta}}<br>
                                    Ficha: {{$fc->paciente->numero_ficha}}<br>
                                </div>

                                <div class="media-body" style="width: 40%" >

                                    Idade: {{\Carbon\Carbon::parse($fc->paciente->idade)->DiffInMonths(\Carbon\Carbon::today())}} Meses<br>
                                    Cliente: {{$fc->paciente->cliente->nome}} {{$fc->paciente->cliente->apelido}}<br>
                                    Contacto: {{$fc->paciente->cliente->contacto1}} {{$fc->paciente->cliente->contacto2}}<br>
                                    @endif
                                </div>
                                
                            </div>
                            <i><small><a href="">Clique aqui para ver com mais detalhes...</a></small></i>
                        </div>
                    </a>
                </td>
                <td><p class="pull-right"><small>{{$fc->created_at->diffForHumans()}}</small></p></td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>
</div>
</div>


{!!  $calendario_detalhes->script() !!}


<script type="text/javascript">

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

</script>

    <script>
         
    $(document).ready(function() {
        $('#reclatodas').DataTable( {

            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "order": [[ 0, "desc" ]],
            responsive: true,
            dom: 'lfBrtip',
            buttons: [
                'excel', 'print'
            ],

        } 
        );
    } );
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $graf->script()!!}

@section('css')


    
@stop
@stop
