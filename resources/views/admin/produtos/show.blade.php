@extends('adminlte::page')

@section('title', ' | Cadastro de Produtos')

@section('content_header')
    <h1>Produtos</h1>
@stop

@section('content')


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Editar  Produto
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-3 col-lg-offset-4">
        <form method="post" action="{{url('produto/update',$produtos->id)}}" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
             @if(isset($produtos))
            <div class="row">
                    <div class="from-group ">
                        <label>Nome</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$produtos->name}}" required autofocus>
                    </div>
            </div>
            <div class="row">
                    <div class="from-group ">
                        <label>Peso Liquido em Kg</label>
                        <input type="text" name="peso" id="peso" class="form-control"  value="{{$produtos->peso}}" >
                    </div>
            </div>
            <div class="row">
                    <div class="from-group ">
                        <label>Codigo do Produto</label>
                        <input type="text" name="codigoproduto" id="codigoproduto" class="form-control" value="{{$produtos->codigoproduto}}" required autofocus>
                    </div>
            </div>
            <div class="row">
                    <div class="from-group ">
                        <label>Codigo de Barras</label>
                        <input type="text" name="codigobarra" id="codigobarra" class="form-control" value="{{$produtos->codigobarra}}"  autofocus>
                    </div>
            </div>

            <div class="row">
                    <div class="from-group ">
                        <label>Brand</label>
                        <input type="text" name="brand" id="brand" class="form-control" value="{{$produtos->brand}}" required autofocus>
                    </div>
            </div>

            <div class="row">
                    <div class="from-group ">
                        <label>Descrição</label>
                        <input type="text" name="description" id="description" class="form-control" value="{{$produtos->description}}" required autofocus>
                    </div>
            </div>

            <div class="row">
                    <div class="from-group ">
                        <label>Tipo de Unidade de Medida</label>
                        <input type="text" name="tipodeunidadedemedida" id="tipodeunidadedemedida" class="form-control" value="{{$produtos->tipodeunidadedemedida}}" required autofocus>
                    </div>
            </div>

            <div class="row">
                    <div class="from-group ">
                        <label>Unidade de Medida</label>
                        <input type="number" name="unidadedemedida" id="unidadedemedida" class="form-control" value="{{$produtos->unidadedemedida}}" >
                    </div>
            </div>

            <div class="row">
                    <div class="from-group ">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control" value="{{old('status')}}" required autofocus>
                            @if($produtos->status==0)
                            <option selected="" value="{{$produtos->status}}">Desativado </option>
                            <option  value="1">Ativado </option>
                            @elseif($produtos->status=1)
                            <option selected="" value="{{$produtos->status}}">Ativado </option>
                            <option  value="0">Desativado </option>

                            @endif
                        </select>

                    </div>
            </div>


            <div class="row">
                    <div class="from-group">
                        <label>Stock minimo (unidade)</label>
                        <input step="0.01" type="number" name="stock" id="stock" value="{{$produtos->stock}}" >
                    </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label>Imagem</label>
                    <img src="{{asset('storage/'.$produtos->image)}}" style="width:200px; height:auto; clear:both; display:block;  border:1px solid #ddd; margin-bottom:10px;">
                    <input type="file"  name="image" class="form-control">
                </div>
            </div>


            <div class="row">

                <div class="from-group text-right col-md-12">
                     <label></label>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </div>

           @endif
        </form>


    </div>

</div>

</div>
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
