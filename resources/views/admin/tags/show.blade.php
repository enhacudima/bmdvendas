@extends('adminlte::page')

@section('title', ' | Tags Show')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li> <a href="{{ url('ficha-clinica') }}"> Ficha Clinica </a></li>
        <li> <a href="{{ route('tags.index') }}"> Tags </a></li>
        <li class="active">Edit</li>
    </ol>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Actualização de Dados da Tag
                    
                </h4>
            </div>

                <div class="panel-body">
                        <form autocomplete="Active" accept-charset="UTF-8" method="POST"
                              action="{{route('tags.update', $tags->id)}}" enctype="multipart/form-data">
                            <input name="_method" type="hidden" value="PATCH">
                            {{ csrf_field() }}

                            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>
                            <input   name="id" type="hidden" id="id" value="{{$tags->id }}" required autofocus>

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Nome</label>
                                        <input type="text" name="name" id="name"  value="{{$tags->name}}" class="form-control" required autofocus>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Tipo</label>
                                        <input type="text" name="type" id="type"  value="{{$tags->type}}" class="form-control" required autofocus>
                                    </div>
                            </div> 
                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Descrição</label>
                                        <textarea name="description" id="description" required autofocus class="form-control" >{{$tags->description}}</textarea>
                                    </div>
                            </div>  

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Estado</label>
                                        @if($tags->status==1)
                                            <p><input type="radio" name="status" value="1" checked><label>Activo</label></p>
                                            <p><input type="radio" name="status" value="0"><label>Desativado</label></p>
                                            @else
                                             <p><input type="radio" name="status" value="1" ><label>Activo</label></p>
                                             <p><input type="radio" name="status" value="0" checked><label>Desativado</label></p>
                                             @endif
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

    
@stop
@stop
