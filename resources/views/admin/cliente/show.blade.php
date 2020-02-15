@extends('adminlte::page')

@section('title', ' | Banho Show')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Gestão de Clientes 
        </h4>
    </div>

    <div class="panel-body">

        <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Formulario de Actualização de Dados do Cliente
                    <a href="{{ url('index_cliente') }}" class="btn btn-success btn-xs pull-right">Voltar a pagina principal</a>
                </h4>
            </div>

                <div class="panel-body">
                        <form method="post" action="{{url('updatecliente')}}" autocomplete="Active" accept-charset="UTF-8" >
                            {{ csrf_field() }}

                            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>
                            <input   name="id" type="hidden" id="id" value="{{$client->id }}" required autofocus>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Nome</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $client->name}}" required autofocus>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Apelido</label>
                                        <input type="text" name="sname" id="sname" class="form-control" value="{{$client->sname}}" required autofocus>
                                    </div>
                            </div>         

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Morada</label>
                                        <input type="text" name="morada" id="morada" class="form-control" value="{{$client->morada}}" required autofocus placeholder="Provincia/Cidade,bairro">
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Data de Nascimento</label>
                                        <input type="date" name="data_nasce" id="data_nasce" class="form-control" value="{{$client->data_nasce}}" required autofocus>
                                    </div>
                            </div> 

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Contacto 1</label>
                                        <input type="number" name="contacto1" id="contacto1" class="form-control" value="{{$client->contacto1}}" required autofocus placeholder="Ex: 84*******">
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Contacto 2</label>
                                        <input type="number" name="contacto2" id="contacto2" class="form-control" value="{{$client->contacto2}}"  autofocus placeholder="Ex: 86*******">
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Credito (Sim/Não)</label>
                                        <select class="form-control" id="credito" name="credito" >
                                            <option value="Nao" selected="">Nao</option>
                                            <option value="Sim">Sim</option>
                                        </select>
                                    </div>
                            </div>       


                            <div class="row">

                                <div class="from-group text-right col-md-12">
                                     <label></label>
                                    <input class="btn btn-primary" type="submit" value="Atualizar">
                                </div>
                            </div>         
                           
                        </form>
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
