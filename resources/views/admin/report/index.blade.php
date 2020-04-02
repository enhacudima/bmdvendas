@extends('adminlte::page')

@section('title',' | Report')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
     @if (Auth::user()->can('view_all_files'))
     <a class="btn btn-social-icon btn-github" aria-hidden="true" href="{{url('admin/meusficheiros/all/deletefile')}}" ><i class=" fa fa-trash-o "></i></a>
     @endif
    </h1>
@stop

@section('content')
@include('notification')

 <div class="box box-solid box-default">
   <div class="box-header">
              <center><h3 class="box-title"><strong><i class="fa fa-fw fa-folder-open"></i> Report </strong></h3></center>

    </div>
    <div class="panel-body">

    <div class="box-body table-responsive no-padding">  

     <table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead >
        <tr>
            <th scope="col">ID</th>
            <th scope="col"><center>Ficheiro</center></th>
            <th scope="col">Avatar</th>
            <th scope="col">Nome</th>
            <th scope="col">Criado em</th>
            <th scope="col">Time ago</th>
            <th scope="col">Estado</th>
        </tr>
        </thead>
        <tbody>
            @if($data)
                @foreach($data as $value)
                <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->filename}}</td>
                <td><img src="{{asset('storage/'.$value->avatar)}}" class="img-circle" alt="User Image" width="25px" height="25px"> {{$value->user_name}} {{$value->user_last_name}}</td>  
                <td>{{$value->name}}</td>
                <td>{{$value->created_at}}</td>
                <td>{{$value->created_at->diffForHumans()}}</td>
                    @if($value->status)
                    <td><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i> Processando..</td>
                    @else
                    <td><a class="fa fa-cloud-download " aria-hidden="true" href="{{url('admin/file/download',$value->filename)}}" target="_blank"> Baixar</a> <a class="fa fa-trash-o " aria-hidden="true" href="{{url('admin/meusficheiros/deletefile',$value->filename)}}" > Eliminar</a> </td>
                    @endif
                </tr>

                @endforeach
            @endif
        </tbody>
    </table>
  </div>
</div>
 </div>


<style type="text/css">
    .table{
        font-size: 10.7px;
    }
</style>


<script type="text/javascript">

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        "order": [[ 0, "desc" ]],
        "columnDefs": [
                        { "type": "date-eu", "targets": 6 }
                      ],
        buttons: [
            {
              extend: 'copy',
              text: '<i class="fa fa-files-o"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'excel',
              text: '<i class="fa fa-file-excel-o"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'csv',
              text: '<i class="fa fa-file-text-o"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'pdf',
              text: '<i class="fa fa-file-pdf-o"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'print',
              text: '<i class="fa fa-fw fa-print"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
            {
              extend: 'colvis',
              text: '<i class="fa fa-fw fa-eye-slash"></i>',
              exportOptions: {
                columns: ':visible'

              }
            },
        ]
    } );
} );

</script>
@stop
