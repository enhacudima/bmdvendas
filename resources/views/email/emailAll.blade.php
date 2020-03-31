@extends('adminlte::page')

@section('title', ' | Email')

@section('content_header')
<h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa fa-fw fa-arrow-left"></i></a>
<a class="btn btn-social-icon btn-github"  href="{{ url('email') }}"><i class="fa fa-fw fa-plus"></i></a></h1>
 
@stop

@section('content')

<div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-envelope-o"></i> ALL<span class="label label-danger pull-right">{{$sent+$drafts}}</span></a></li>
                <li class=""><a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-info pull-right">{{0}}</span></a></li>
                <li class=""><a href="#"><i class="fa fa-envelope-o"></i> Sent<span class="label label-warning pull-right">{{$sent}}</span></a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts <span class="label label-primary pull-right">{{$drafts}}</span></a></li>
                <li><a href="#"><i class="fa fa-filter"></i> Junk </a>
                </li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Mails</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped" id="example">
                    <thead >
                        <tr>
                            <th></th>
                            <th scope="col">Nome</th>
                            <th scope="col">Assunto</th>
                            <th scope="col">Time</th>
                            <th scope="col">Data</th>
                            <th scope="col"></th>
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
            "ajax": "{{ url('email/allsource') }}",
            "columns": [
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": "",
                    'name':'assunto'
                },
                { "data": "name",'name':'users.name' },
                                {
                  data: null,
                  render: function ( data, type, row ) {
                    return '<b>'+data.name_cliente+'</b> - '+data.assunto+'';
                  },
                  'name':'name_cliente'
                },
                { "data": "created_at" },
                { "data": "time" },
                {
                  data: null,
                  render: function ( data, type, row ) {
                    return '<a  href="{{url(url("emailtry/"))}}/'+data.id+'" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>';
                  },
                  'name':'assunto'
                }
            ],
            "rowCallback": function (row, data) {
                if ($.inArray(data.DT_RowId, selected) !== -1) {
                    $(row).addClass('selected');
                }
            }
        });


    $('#example tbody').on('click', 'tr', function () {
        var id = this.id;
        var index = $.inArray(id, selected);
 
        if ( index === -1 ) {
            selected.push( id );
        } else {
            selected.splice( index, 1 );
        }
 
        $(this).toggleClass('selected');
    });

    // Array to track the ids of the details displayed rows
    var detailRows = [];
 
    $('#example tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );
 
        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            row.child.hide();
 
            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( format( row.data() ) ).show();
 
            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
    } );
 
    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    });

    });

    function format(d) {
        if (d.status==1) {
          $sta='<span class="label label-warning pull-right">Não processado</span>'
        }else{
          $sta='<span class="label label-primary pull-right">Processado</span>'
        }
        $m=jQuery('<div />').html(d.message).text();
        $messagem = 'Para: ' + d.name_cliente +' - ' + d.to+ '<br>'+$sta+ '<br>' +$m+'<br>';
        return $messagem;
    }


</script>

@stop