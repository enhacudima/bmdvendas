@extends('adminlte::page')

@section('title', ' | Report Movimentos Produtos')

@section('content_header')
    <h1>Report</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Report Tipo de Pagamento
        </h4>
    </div>

    <div class="panel-body">
<div class="row">
    

        <form id="myForm" name="myForm" action="{{url('/report_pagamentos_filter')}}" method="post">
                @csrf
                {{ csrf_field() }}
        <div class="">
        <div class="form-group col-sm-2">
                <label >Data Inicio</label>
              
                        <input class="form-control" type="date" tyle="width: 100%"  id="inicio"  name="inicio" required autofocus>
                

        </div>

        <div class="form-group  col-sm-2 ">
                <label >Data Fim</label>
               
                        <input class="form-control" type="date" tyle="width: 100%"  id="fim"  name="fim" required autofocus >
            

        </div>

        </div>

        <div class="form-group  col-sm-2 col-sm-offset-1">
        <p class="submit">
            <strong>
            <button type="submit" class="btnEmidio btn btn-primary bord0" value="1" id="gravar">Atualizar </button>
            </strong>
        </p>

        </div>   


    <input hidden="" htype="" name="idusuario" id="idusuario" value="{{ Auth::user()->id }}">
    <input hidden="" htype="" name="loanid" id="loanid" value="">         


    </form> 

  </div>  

    <div class="col-lg-12">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Resumo de Pagamentos por Tipo
        </h4>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">     
        <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
            <thead >
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tipo de Pagamento</th>
                <th scope="col">Valor</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($pagamentos))  
            @php($i=0)  
            @foreach($pagamentos as $key => $cil)
            <tr>
                 <td>{{$key+1}}</td>   
                 <td>{{$cil->fpagamento}}</td>
                 <td>{{number_format($cil->total_venda, 2, ".", "")}}</td>
                  
            </tr>
             @php($i=$cil->total_venda+$i)
            @endforeach 
            @endif 
            <tr>
                <td></td>
                <td>Total:</td>
                <td>{{number_format($i,2, ".", "")}} MTN</td>
            </tr>


            </tbody>
        </table>
    </div>    
        </div>
    </div>
</div>
</div>

</div>
@stop
@section('js')

<script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>

    <script>
         
    $(document).ready(function() {
        $('#reclatodas').DataTable( {

            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "order": [[ 0, "desc" ]],
            responsive: true,
            dom: 'lfBrtip',
            buttons: [
                'excel', 'print'
            ],

        } 
        );
    } );
    </script>

    


@stop

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css"> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.material.min.css">   

<style type="text/css">
    .dataTables_wrapper .dt-buttons {
  float:none;  
  text-align:center;
  margin-bottom: 30px;
}
</style>





    <!--Out radius bottons-->
    <style type="text/css">

    /*Global*/

        .bord0 {
        border-radius: 0;
        }

        
    </style>
@stop
