@extends('adminlte::page')

@section('title', ' | Facturas')

@section('content_header')
<h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa fa-fw fa-arrow-left"></i></a>
 
@stop

@section('content')


 <div class="box box-solid box-default">
   <div class="box-header">
              <center><h3 class="box-title"><strong><i class="fa fa-fw fa-folder-open"></i> Facturas </strong></h3></center>

    </div>
    <div class="panel-body">

    <div class="box-body table-responsive no-padding">  

     <table id="example" class="table table-striped  table-hover" style="width:100%">
            <thead >
                <tr>
                    <th>Code</th>
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

   


      <!-- start: Delete Coupon Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h3 class="modal-title" id="myModalLabel">Warning!</h3>

            </div>
            <div class="modal-body">
                 <h4> Are you sure you want to DELETE?</h4>

            </div>
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Yes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


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
        var newRow='';
        var dt = $('#example').DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25,
            "order": [[6, "desc"]],
            "ajax": "{{ url('facturas/allsource') }}",
            "columns": [
                { "data": "codigo_venda" },
                { "data": "name",'name':'users.name' },
                { 
                    data:null,
                    render:function ( data, type, row ) {
                      return new Intl.NumberFormat().format(data.total_venda);
                    },
                    "name":"venda_troco.total_venda" 
                },
                { 
                    data:null,
                    render:function ( data, type, row ) {
                      return new Intl.NumberFormat().format(data.total_pago);
                    },
                    "name":"venda_troco.total_pago"
                },
                { 
                    data:null,
                    render:function ( data, type, row ) {
                      return new Intl.NumberFormat().format(data.total_porpagar);
                    },
                    "name":"venda_troco.total_porpagar"
                },
                { 
                    data:null,
                    render:function ( data, type, row ) {
                      return new Intl.NumberFormat().format(data.total_troco);
                    },
                    "name":"venda_troco.total_troco"
                },
                { "data": "time" },
                { "data": "created_at" },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    return '<a class="btn  btn-info btn-flat btn-xs" href="{{url("vendas/ultima")}}'+'/'+data.codigo_venda+'"> <i class="fa fa-info-circle" aria-hidden="true"></i></a>';

                  },
                  'name':'venda_troco.codigo_venda'
                },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    return '<a target="_blanck" class="btn  btn-info btn-flat btn-xs" href="{{url("vendas/ultima/print")}}'+'/'+data.codigo_venda+'"><i class="fa fa-print" aria-hidden="true"></i>  </a>';

                  },
                  'name':'venda_troco.codigo_venda'
                },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    return '<button class="btn  btn-danger btn-flat btn-xs "  data-id='+data.codigo_venda+' > <i class="fa fa-trash" aria-hidden="true"></i></button>';
                  },
                  'name':'venda_troco.codigo_venda',
                  "class": 'btnDelete'
                }
            ],
        });


      $('#example tbody').on( 'click', 'tr td.btnDelete', function  () {
           var tr = $(this).closest('tr')
           var row = dt.row( tr )
           var data =row.data();
           var id = data.codigo_venda;
           newRow=$(this);
           //console.log(id);
          $('#myModal').data('id', id).modal('show');
      });



    $('#btnDelteYes').click(function () {
        var id = $('#myModal').data('id');

          $.ajax({
           url: "{{ url('vendas/eliminar/venda')}}",
           type: 'get',
           data: {data:id},
           success: function (response) {
              if (response.status==false) {
                  toastr.error(response.msg);

              } else if (response.status==true)
                {
                   toastr.success(response.msg);
                }
              else{
                  response.errors.forEach(myFunction);

                  function myFunction(item, index) {
                       toastr.error(item);
                      
                    }
              }
           }
         })

        //console.log(newRow);
        newRow.parent().remove();
        $('#myModal').modal('hide');
    });

    })


</script>

@stop