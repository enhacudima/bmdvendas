@extends('adminlte::page')

@section('title', ' | Cadastro de Mesa Update')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Sala: {{$mesa->name}}
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-6 col-md-offset-3">
        <form method="post" action="{{url('updatemesa')}}" autocomplete="Active" accept-charset="UTF-8" >
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <input   name="id" type="hidden" id="id" value="{{ $mesa->id }}" required autofocus>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$mesa->name}}" required autofocus>
                    </div>
            </div>        

            <div class="row">
                    <div class="from-group col-lg-12">
                       <label><a href="#" data-toggle="tooltip" title="Escreva banho caso seja Sala-de-Banho/consultorio">Descrição</a></label>
                        <input type="text" name="description" id="description" class="form-control" value="{{$mesa->description}}" required autofocus>
                    </div>
            </div>       
     

            <div class="row">

                <div class="from-group text-right col-md-12">
                     <label></label>
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </div>   
                
           
        </form>
        

    </div>
    
</div>

</div>
<script type="text/javascript">

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

</script>

@stop

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
