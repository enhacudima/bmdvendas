@extends('adminlte::page')

@section('title', ' | Report Inflow')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Report Inflow/Cash
        </h4>
    </div>

    <div class="panel-body">

        <form id="myForm" name="myForm" action="{{url('/report_inflow_filter')}}" method="post">
            @csrf
            {{ csrf_field() }}
            <input hidden="" htype="" name="idusuario" id="idusuario" value="{{ Auth::user()->id }}">
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

            <div class="form-group  col-sm-2 col-sm-offset-1" style="padding-top: 20px" >
                <p class="submit">
                    <strong>
                    <button type="submit" class="btnEmidio btn btn-primary bord0" value="1" id="gravar">Atualizar </button>
                    </strong>
                </p>
            </div>
        </form>



    <div class="col-lg-12">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Lista de ajustes
        </h4>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">
        <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
            <thead >
            <tr>
                <th scope="col">Mesa</th>
                <th scope="col">Agente</th>
                <th scope="col">Total de Venda</th>
                <th scope="col">Total Pago</th>
                <th scope="col">Total Por Pagar</th>
                <th scope="col">Total Troco</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($movimentos))
            @php($v=0)
            @php($p=0)
            @php($po=0)
            @php($t=0)
            @foreach($movimentos as $cil)
                <tr>
                <td>{{$cil->mesa}}</td>
                <td>{{$cil->username}}</td>
                <td>{{number_format($cil->total_venda,2)}}</td>
                <td>{{number_format($cil->total_pago,2)}}</td>
                <td>{{number_format($cil->total_porpagar,2)}}</td>
                <td>{{number_format($cil->total_troco,2)}}</td>
                @php($v=$cil->total_venda+$v)
                @php($p=$cil->total_pago+$p)
                @php($po=$cil->total_porpagar+$po)
                @php($t=$cil->total_troco+$t)
                </tr>
            @endforeach
                <tr>
                    <td></td>
                    <td>Total:</td>
                    <td>{{number_format($v,2)}} MTN</td>
                    <td>{{number_format($p,2)}} MTN</td>
                    <td>{{number_format($po,2)}} MTN</td>
                    <td>{{number_format($t,2)}} MTN</td>
                </tr>
            @endif
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

        } );
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
