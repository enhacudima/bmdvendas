@extends('adminlte::page')

@section('title', ' | Email')

@section('content_header')
<h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa fa-fw fa-arrow-left"></i></a>
 
@stop

@section('content')

<div class="row">

        <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Facturas</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped" id="example">
                    <thead >
                        <tr>
                            <th>Usuario</th>
                            <th scope="col">Total</th>
                            <th scope="col">Pago</th>
                            <th scope="col">A pagar</th>
                            <th scope="col">troco</th>
                            <th scope="col">Time</th>
                            <th scope="col">Data</th>
                            <th scope="col">Informação</th>
                            <th scope="col">Imprimir</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                  <tbody>
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
<style>
    td.details-control {
    background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
    }
    tr.details td.details-control {
        background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
    }
</style>
<script>
        $('.textarea').ckeditor();
</script>
<script>
    $(document).ready(function () {
        var selected = [];
        var dt = $('#example').DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "order": [[1, "desc"]],
            "ajax": "{{ url('facturas/allsource') }}",
            "columns": [
                { "data": "name",'name':'users.name' },
                { "data": "total_venda" },
                { "data": "total_pago" },
                { "data": "total_porpagar" },
                { "data": "total_troco" },
                { "data": "created_at" },
                { "data": "time" },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    return '<a class="btn  btn-info btn-flat btn-xs" href="{{url("vendas/ultima")}}'+'/'+data.codigo_venda+'"> <i class="fa fa-info-circle" aria-hidden="true"></i></a>';

                  },
                  'name':'assunto'
                },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    return '<a target="_blanck" class="btn  btn-info btn-flat btn-xs" href="{{url("vendas/ultima/print")}}'+'/'+data.codigo_venda+'"><i class="fa fa-print" aria-hidden="true"></i>  </a>';

                  },
                  'name':'assunto'
                },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    return '<a class="btn  btn-danger btn-flat btn-xs" href="{{url("vendas/eliminar/venda")}}'+'/'+data.codigo_venda+'"> <i class="fa fa-trash" aria-hidden="true"></i></a>';
                  },
                  'name':'assunto'
                }
            ],
        });
    })

</script>

@stop