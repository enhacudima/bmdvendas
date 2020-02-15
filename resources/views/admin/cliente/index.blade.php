@extends('adminlte::page')

@section('title', ' | Cadastro de Sala')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Novo cliente
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-3">
                        <form method="post" action="{{url('storcliente')}}" autocomplete="Active" accept-charset="UTF-8" >
                            {{ csrf_field() }}

                            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Nome</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required autofocus>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Apelido</label>
                                        <input type="text" name="sname" id="sname" class="form-control" value="{{old('sname')}}" required autofocus>
                                    </div>
                            </div>         

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Morada</label>
                                        <input type="text" name="morada" id="morada" class="form-control" value="{{old('morada')}}" required autofocus placeholder="Provincia/Cidade,bairro">
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Data de Nascimento</label>
                                        <input type="date" name="data_nasce" id="data_nasce" class="form-control" value="{{old('data_nasce')}}" required autofocus>
                                    </div>
                            </div> 

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Contacto 1</label>
                                        <input type="number" name="contacto1" id="contacto1" class="form-control" value="{{old('contacto1')}}" required autofocus placeholder="Ex: 84*******">
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Contacto 2</label>
                                        <input type="number" name="contacto2" id="contacto2" class="form-control" value="{{old('contacto2')}}"  autofocus placeholder="Ex: 86*******">
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Credito (Sim/Não)</label>
                                        <select class="form-control" id="credito" name="credito">
                                            <option value="Nao" selected="">Nao</option>
                                            <option value="Sim">Sim</option>
                                        </select>
                                    </div>
                            </div>       


                            <div class="row">

                                <div class="from-group text-right col-md-12">
                                     <label></label>
                                    <input class="btn btn-primary" type="submit" value="Cadastrar">
                                </div>
                            </div>         
                           
                        </form>
        

    </div>
    

    <div class="col-lg-9">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Lista de Clientes
        </h4>
    </div>

    <div class="panel-body">

        
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Apelido</th>
            <th scope="col">Morada</th>
            <th scope="col">Data de Nascimento</th>
            <th scope="col">Contacto 1</th>
            <th scope="col">Contacto 2</th>
            <th scope="col">Credito</th>
            <th scope="col">Data de atualização</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($cliente))    
        @foreach($cliente as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>             
                <a class="btn btn btn-success btn-xs" href="{{action('ClienteController@clienteshow', $cil->id)}}">
                    <i class="fa fa-pencil fa-fw"></i> {{$cil->name}}
                </a>
            </td> 
             <td>{{$cil->sname}}</td>
             <td>{{$cil->morada}}</td>
             <td>{{$cil->data_nasce}}</td>
             <td>{{$cil->contacto1}}</td>
             <td>{{$cil->contacto2}}</td>
             <td>{{$cil->credito}}</td>
             <td>{{$cil->updated_at}}</td>
            </tr>
        @endforeach 
        @endif   
        </tbody>
    </table>
        </div>
    </div>
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
