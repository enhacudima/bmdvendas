@extends('adminlte::page')

@section('title', ' | Paciente Show')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li> <a href="{{ url('index_cliente') }}"> Clientes </a></li>
        <li> <a href="{{ route('paciente.index') }}"> Pacientes </a></li>
        <li class="active">Edit</li>
    </ol>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Actualização de Dados do Paciente
                    
                </h4>
            </div>

                <div class="panel-body">
                        <form autocomplete="Active" accept-charset="UTF-8" method="POST"
                              action="{{route('paciente.update', $paciente->id)}}" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PATCH">
                            {{ csrf_field() }}

                            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>
                            <input   name="id" type="hidden" id="id" value="{{$paciente->id }}" required autofocus>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Cliente</label>
                                    <select name="cliente_id" id="cliente_id" class="form-control" value="{{$paciente->cliente_id}}" required autofocus>
                                        @if(isset($clientes))
                                            @foreach($clientes as $data)
                                                <option value="{{$data->id}}">{{$data->nome}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Nome do paciente</label>
                                    <input type="text" name="nome" id="nome" class="form-control" value="{{$paciente->nome}}" required autofocus>
                                </div>
                            </div>



                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Caderneta</label>
                                    <input type="text" name="caderneta" id="caderneta" class="form-control" value="{{$paciente->caderneta}}" required autofocus>
                                </div>
                            </div>


                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Especie</label>
                                    <select name="especie" id="especie" class="form-control" value="{{$paciente->especie}}" required autofocus>
                                        @if(isset($especies))
                                            @foreach($especies as $data)
                                                <option value="{{$data->nome}}">{{$data->nome}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Raça</label>
                                    <select name="raca" id="raca" class="form-control" value="{{$paciente->raca}}" required autofocus>
                                        @if(isset($racas))
                                            @foreach($racas as $data)
                                                <option value="{{$data->nome}}">{{$data->nome}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Sexo</label>
                                    <select name="sexo" id="sexo" class="form-control" value="{{$paciente->sexo}}" required autofocus>
                                        <option value="M">Macho</option>
                                        <option value="F">Fémia</option>
                                        <option value="O">Outro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Data de Nascimento</label>
                                    <input type="date" name="idade" id="idade" class="form-control" value="{{$paciente->idade}}"  autofocus>
                                </div>
                            </div>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Pelagem</label>
                                    <select name="pelagem" id="pelagem" class="form-control" value="{{$paciente->pelagem}}" required autofocus>
                                        @if(isset($pelagem))
                                            @foreach($pelagem as $data)
                                                <option value="{{$data->nome}}">{{$data->nome}}</option>
                                            @endforeach
                                        @endif
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
