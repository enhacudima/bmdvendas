@extends('adminlte::page')

@section('title', ' | Cliente Show')

@section('content_header')
        <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('index_cliente') }}">Clientes</a></li>
        <li class="active">Edit</li>
    </ol>
@stop

@section('content')


        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Actualização de Dados do Cliente
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
                                        <input type="text" name="nome" id="nome" class="form-control" value="{{ $client->nome}}" required autofocus>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Tipo de Cliente</label>
                                        <input type="text" name="tipo" id="tipo" class="form-control" value="{{$client->tipo}}" required autofocus>
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>NUIT</label>
                                        <input type="text" name="nuit" id="nuit" class="form-control" value="{{$client->nuit}}" >
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Morada</label>
                                        <input type="text" name="endereco" id="endereco" class="form-control" value="{{$client->endereco}}" required autofocus placeholder="Provincia/Cidade,bairro">
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
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{$client->email}}"  autofocus placeholder="Ex: 86*******">
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

    @include('admin.cliente.sales')

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
