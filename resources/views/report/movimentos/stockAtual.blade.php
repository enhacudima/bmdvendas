@extends('adminlte::page')

@section('title', ' | Report Movimentos Produtos')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Saldo min</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Saida</th>
                    <th scope="col">Saldo</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($movimentos))
                @php($i=0)
                @foreach($movimentos as $cil)
                    <tr>
                    <td>{{$cil->id}}</td>
                    <td><img src="{{asset('storage/'.$cil->image)}}" style="width:80px;  clear:both; display:block;  border:1px solid #ddd; margin-bottom:10px;"></td>
                    <td>
                        <a class="btn btn btn-success btn-xs" href="{{action('ProdutoController@show', $cil->id)}}">
                            <i class="fa fa-pencil fa-fw"></i> {{$cil->name}}
                        </a>
                    </td>
                    <td>{{$cil->codigoproduto}}</td>
                    <td>{{$cil->stock}}</td>
                    <td>{{$cil->total_entrada}}</td>
                    <td>{{$cil->total_saida}}</td>
                    @if($cil->stock >= ($cil->saldo))
                    <td>
                    <a class="btn btn btn-danger btn-xs" >
                        {{$cil->saldo}}
                    </a></td>
                    @else
                    <td>{{$cil->saldo}}</td>
                    @endif
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
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
