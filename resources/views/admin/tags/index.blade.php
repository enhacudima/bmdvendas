@extends('adminlte::page')

@section('title', ' | Tags')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url('ficha-clinica') }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Tags</li>
    </ol>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--model-->
<div class="modal fade bd-example-modal-lg" id="modal-default"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Novo Tag</h4>
      </div>
      
        <form method="post" action="{{route('tags.store')}}" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}
            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Nome</label>
                        <input type="text" name="name" id="name"  value="{{old('name')}}" required autofocus>
                    </div>
            </div>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Tipo</label>
                        <input type="text" name="type" id="type"  value="{{old('type')}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Descrição</label>
                        <textarea name="description" id="description" required autofocus >{{old('escription')}}</textarea>
                    </div>
            </div>         

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
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
               <i class="fa fa-plus"></i> Novo Tag 
        </button>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">      
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Tipo</th>
            <th scope="col">Descriprion</th>
            <th scope="col">Usuario</th>
            <th scope="col">Data de atualização</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($tags))    
        @foreach($tags as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>             
                <a class="btn btn btn-success btn-xs" href="{{action('TagsController@show', $cil->id)}}">
                    <i class="fa fa-eye fa-fw"></i> {{$cil->name}}
                </a>
            </td> 
             <td>{{$cil->type}}</td>
             <td>{{$cil->description}}</td>
             <td>{{$cil->user->name}}</td>
             <td>
                 @if($cil->status==1)
                    Activo
                    @else
                        Desativado
                 @endif
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
