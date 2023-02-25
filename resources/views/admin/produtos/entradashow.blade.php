@extends('adminlte::page')

@section('title', ' | Edit Entrada')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class=""><a href="{{ url('produto') }}">Produtos</a></li>
        <li class=""><a href="{{ url('produto_entrada') }}">Entradas</a></li>
        <li class="active">Show</li>
    </ol>
@stop

@section('content')


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Edit Entrada: {{$produtos[0]->lot}}
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-3  col-lg-offset-4">
        <form method="post" action="{{{url('produto/entrada/update')}}}" autocomplete="Active" accept-charset="UTF-8" >
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <input   name="id" type="hidden" id="id" value="{{$produtos[0]->id}}" required autofocus>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Produto</label>
                        <input type="text" value="{{$produtos[0]->name}}">
                        <input type="text" name="produto_id" id="produto_id" value="{{$produtos[0]->produto_id}}" hidden="">
                    </div>
            </div>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Tipo de unidade de medida</label>
                        <input   value="{{$produtos[0]->tipodeunidadedemedida}}" disabled="">
                    </div>
            </div>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Unidade de Medida</label>
                        <input   value="{{$produtos[0]->unidadedemedida}}" disabled="">
                    </div>
            </div>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Quantidade</label>
                        <input step="any" type="number"  name="quantidade" id="quantidade" class="form-control quantidade" value="{{$produtos[0]->quantidade}}" required autofocus>
                    </div>
            </div>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Custo Total de aquisição</label>
                        <input step="any" type="number" name="precodecompra" id="precodecompra" class="form-control precodecompra" value="{{$produtos[0]->precodecompra}}"  autofocus>
                    </div>
            </div>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Margem (%)</label>
                        <input  step="any" type="number" name="margem_per" id="margem_per" class="form-control" value="{{$produtos[0]->margem_per}}" required autofocus>
                    </div>
            </div>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Preço de revenda</label>
                        <input step="any" type="number"  name="final_p" id="final_p" class="form-control final_p" value="{{$produtos[0]->preco_final}}" required autofocus >
                    </div>
            </div>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Data Expiração</label>
                        <input  type="date" name="data_exp"  class="form-control " value="{{$produtos[0]->data_exp}}"  >
                    </div>
            </div>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Fornecedor</label>
                        <input  type="text" name="fornecedor"  class="form-control " value="{{$produtos[0]->fornecedor}}"  >
                    </div>
            </div>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Telefone Fornecedor</label>
                        <input  type="number" name="telefone"  class="form-control " value="{{$produtos[0]->telefone}}"  >
                    </div>
            </div>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Email Fornecedor</label>
                        <input  type="Email" name="email_fornecedor"  class="form-control " value="{{$produtos[0]->email_fornecedor}}"  >
                    </div>
            </div>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control" value="{{$produtos[0]->status}}" required autofocus>
                            @if($produtos[0]->status==0)
                            <option selected="" value="{{$produtos[0]->status}}">Desativado </option>
                            <option  value="1">Ativado </option>
                            @elseif($produtos[0]->status=1)
                            <option selected="" value="{{$produtos[0]->status}}">Ativado </option>
                            <option  value="0">Desativado </option>

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

</div>
<input type="hidden" id="unidadedemedida" value="{{$produtos[0]->unidadedemedida}}">
    <script>

    $(document).ready(function() {
        $('#reclatodas').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "order": [[ 11, "desc" ]],
            responsive: true,
            dom: 'lfBrtip',
            buttons: [
                'excel', 'print'
            ],

        } );
    } );
    </script>

    <script>
    $('#margem_per').keyup(function(){
        var quantidade =   parseFloat($('#quantidade').val());
        var precodecompra =  parseFloat($('#precodecompra').val());
        var margem_per = parseFloat($('#margem_per').val());
        var unidadedemedida = parseFloat($('#unidadedemedida').val());

        $custo_unitario=(precodecompra/quantidade/unidadedemedida);
        $margem=$custo_unitario*(margem_per/100);
        $preco_final=$custo_unitario+$margem;

         $('#final_p').val(roundN($preco_final,2));

    });


    $('#quantidade').keyup(function(){
        var quantidade =   parseFloat($('#quantidade').val());
        var precodecompra =  parseFloat($('#precodecompra').val());
        var margem_per = parseFloat($('#margem_per').val());
        var unidadedemedida = parseFloat($('#unidadedemedida').val());
        console.log(unidadedemedida);

        $custo_unitario=(precodecompra/quantidade/unidadedemedida);
        $margem=$custo_unitario*(margem_per/100);
        $preco_final=$custo_unitario+$margem;

         $('#final_p').val(roundN($preco_final,2));

    });


    $('#precodecompra').keyup(function(){
        var quantidade =   parseFloat($('#quantidade').val());
        var precodecompra =  parseFloat($('#precodecompra').val());
        var margem_per = parseFloat($('#margem_per').val());
        var unidadedemedida = parseFloat($('#unidadedemedida').val());

        $custo_unitario=(precodecompra/quantidade/unidadedemedida);
        $margem=$custo_unitario*(margem_per/100);
        $preco_final=$custo_unitario+$margem;

       $('#final_p').val(roundN($preco_final,2));

    });

    $('#final_p').keyup(function(){
        var quantidade =   parseFloat($('#quantidade').val());
        var precodecompra =  parseFloat($('#precodecompra').val());
        var custo_unitario = parseFloat($('#final_p').val());
        var unidadedemedida = parseFloat($('#unidadedemedida').val());

        var E2=custo_unitario;
        var B2=quantidade*unidadedemedida;
        var C2=precodecompra;

        $preco_final=(((E2*B2)-C2)/C2)*100;

       $('#margem_per').val(roundN($preco_final,5));

    });


    function roundN(num,n){
      return parseFloat(Math.round(num * Math.pow(10, n)) /Math.pow(10,n)).toFixed(n);
    }

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
