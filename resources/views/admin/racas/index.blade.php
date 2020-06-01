@extends('adminlte::page')

@section('title', ' | Raças')

@section('content_header')
     <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="">Clientes</li>
        <li class="">Pacientes</li>
        <li class="active">Raças</li>
    </ol>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--especie-->
<div class="modal fade bd-example-modal-lg" id="modal-default"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Nova Especie</h4>
      </div>
      
        <form method="post" action="{{url('especie/store')}}" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}
            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>


                <div class="row">
                        <div class="from-group col-lg-12">
                            <label> Nome da Especie</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{old('nome')}}" required autofocus>
                        </div>
                </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!--raca-->
<div class="modal fade bd-example-modal-lg" id="modal-raca"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Novo Raça</h4>
      </div>
        <form method="post" action="{{url('raca/store')}}" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}
            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>

                <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Especie</label>
                        <select name="especies_id" id="especies_id" class="form-control" value="{{old('cliente_id')}}" required autofocus>
                            <option disabled selected ></option>
                            @if(isset($especies))
                                @foreach($especies as $data)
                                    <option value="{{$data->id}}">{{$data->nome}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="row">
                        <div class="from-group col-lg-12">
                            <label>Nome da Raça</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{old('nome')}}" required autofocus>
                        </div>
                </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!--Pelagem-->
<div class="modal fade bd-example-modal-lg" id="modal-pelagem"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Nova Pelagem</h4>
      </div>
      
        <form method="post" action="{{url('especie/store')}}" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}
            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>


                <div class="row">
                        <div class="from-group col-lg-12">
                            <label> Nome da Pelagem</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{old('nome')}}" required autofocus>
                        </div>
                </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




    <div class="panel panel-default">

    <div class="panel-heading">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Nova Especie
        </button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-raca">
                Nova Raca
        </button>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-pelagem">
                Nova Pelagem
        </button>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">     
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Especie</th>
            <th scope="col">Raça</th>
            <th scope="col">Data de atualização</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($racas))
        @foreach($racas as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>{{$cil->nome_especie}}</td>
             <td>
                <a class="btn btn btn-success btn-xs" href="#" style="width: 100%">
                    <i class="fa fa-pencil fa-fw"></i> {{$cil->nome}}
                </a>
            </td>
             <td>{{$cil->updated_at}}</td>
            </tr>
        @endforeach 
        @endif   
        </tbody>
    </table>
</div>
        </div>
    </div>


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

@section('css')
    <style>

        input, textarea {
            padding: 10px;
            border: 1px solid #E5E5E5;
            width: 100%;
            color: #999999;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 8px;
        }

    </style>

    
@stop
@stop
