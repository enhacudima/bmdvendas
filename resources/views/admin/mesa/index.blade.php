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
        <h4>Nova Sala
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-3">
        <form method="post" action="{{url('storemesa')}}" autocomplete="Active" accept-charset="UTF-8" >
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required autofocus>
                    </div>
            </div>        

            <div class="row">


                    <div class="from-group col-lg-12">
                        <label><a href="#" data-toggle="tooltip" title="Escreva banho caso seja Sala-de-Banho/consultorio">Descrição</a></label>
                        <input type="text" name="description" id="description" class="form-control" value="{{old('description')}}" for="FirstName" title="Hooray!" required autofocus>
                    </div>

            </div>       


            <div class="row">

                <div class="from-group text-right col-md-12">
                     <label></label>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </div>         
           
        </form>
        

    </div>
    

    <div class="col-lg-9">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Lista de Salas
        </h4>
    </div>

    <div class="panel-body">

        
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Last update</th>
            <th scope="col">Estado</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($mesas))    
        @foreach($mesas as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>             
                <a class="btn btn btn-success btn-xs" href="{{action('MesaController@show', $cil->id)}}">
                    <i class="fa fa-pencil fa-fw"></i> {{$cil->name}}
                </a>
            </td> 
             <td>{{$cil->description}}</td>

             <td>{{$cil->updated_at}}</td>
             <td>
                 @if($cil->status==1)
                        Livre
                 @else
                    <a class="btn btn btn-success btn-xs" href="{{action('VendasController@index', $cil->id)}}">
                         Ocupada
                    </a>
                 @endif
             </td>
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
