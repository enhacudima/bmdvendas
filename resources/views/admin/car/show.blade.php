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
        <h4>Serviço de Lavagem e Lubrificação de Viaturas
        </h4>
    </div>

    <div class="panel-body">

        <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Formulario de Actualização de Dados da Viatura
                    <a href="{{ url('carindex',$mesa_id) }}" class="btn btn-success btn-xs pull-right">Voltar a pagina principal</a>
                </h4>
            </div>

                <div class="panel-body">
                            <form method="post" action="{{url('atualizar')}}" autocomplete="Active" accept-charset="UTF-8" >
                            {{ csrf_field() }}

                            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>
                            <input   name="id" type="hidden" id="id" value="{{$id}}" required autofocus>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Nome do Proprietario</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{$car->name}}" required autofocus>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Apelido do Proprietario</label>
                                        <input type="text" name="sname" id="sname" class="form-control" value="{{$car->sname}}" required autofocus>
                                    </div>
                            </div>        

                            <div class="row">


                                    <div class="from-group col-lg-12">
                                        <label><a href="#" data-toggle="tooltip" title="certifica que não existe duplicação">Chapa de Matricula</a></label>
                                        <input type="text" name="matricula" id="matricula" class="form-control" value="{{$car->matricula}}" for="FirstName" title="Hooray!" required autofocus>
                                    </div>

                            </div> 

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Marca de Viatura</label>
                                        <input type="text" name="marca" id="marca" class="form-control" value="{{$car->marca}}" required autofocus>
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Modelo de Viatura</label>
                                        <input type="text" name="modelo" id="modelo" class="form-control" value="{{$car->modelo}}" required autofocus>
                                    </div>
                            </div> 

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Contacto 1</label>
                                        <input type="number" name="contacto1" id="contacto1" class="form-control" value="{{$car->contacto1}}" required autofocus>
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Contacto 2</label>
                                        <input type="number" name="contacto2" id="contacto2" class="form-control" value="{{$car->contacto2}}"  autofocus>
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
