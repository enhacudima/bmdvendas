@extends('adminlte::page')

@section('title', ' | Banho Create')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Serviço de Banho
        </h4>
    </div>

    <div class="panel-body">

        <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Formulario de Cadastro do Animal 
                    <a href="{{ url('carindex',$mesa_id) }}" class="btn btn-success btn-xs pull-right">Voltar a pagina principal</a>
                </h4>
            </div>

                <div class="panel-body">
                            <form method="post" action="{{url('storcar')}}" autocomplete="Active" accept-charset="UTF-8" >
                            {{ csrf_field() }}

                            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Nome do Proprietario</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required autofocus>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Apelido do Proprietario</label>
                                        <input type="text" name="sname" id="sname" class="form-control" value="{{old('sname')}}" required autofocus>
                                    </div>
                            </div>        

                            <div class="row">


                                    <div class="from-group col-lg-12">
                                        <label><a href="#" data-toggle="tooltip" title="certifica que não existe duplicação">Numero da Caderneta</a></label>
                                        <input type="text" name="matricula" id="matricula" class="form-control" value="{{old('matricula')}}" for="FirstName" title="Hooray!" required autofocus>
                                    </div>

                            </div> 

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Nome do Animal</label>
                                        <input type="text" name="marca" id="marca" class="form-control" value="{{old('marca')}}" required autofocus>
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Especie</label>
                                        <input type="text" name="modelo" id="modelo" class="form-control" value="{{old('modelo')}}" required autofocus>
                                    </div>
                            </div> 

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Contacto 1</label>
                                        <input type="number" name="contacto1" id="contacto1" class="form-control" value="{{old('contacto1')}}" required autofocus>
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Contacto 2</label>
                                        <input type="number" name="contacto2" id="contacto2" class="form-control" value="{{old('contacto2')}}"  autofocus>
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
