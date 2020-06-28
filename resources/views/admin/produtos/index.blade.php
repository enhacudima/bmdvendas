@extends('adminlte::page')

@section('title', ' | Cadastro de Produtos')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="">Produtos</li>
        <li class="active">Cadastro</li>
    </ol>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--model-->
<div class="modal fade bd-example-modal-lg" id="modal-default"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Novo produto</h4>
      </div>
      
        <form method="post" action="{{url('storeproduto')}}" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <div class="row">
                    <div class="from-group ">
                        <label>Nome</label>
                        <input type="text" name="name" id="name"  value="{{old('name')}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group ">
                        <label>Peso Liquido em Kg</label>
                        <input type="number" step="any" name="peso" id="peso"  value="{{old('peso')}}" >
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group ">
                        <label>Codigo do Produto</label>
                        <input type="text" name="codigoproduto" id="codigoproduto"  value="{{old('codigoproduto')}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group ">
                        <label>Codigo de Barras</label>
                        <input type="text" name="codigobarra" id="codigobarra"  value="{{old('codigobarra')}}"  autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group ">
                        <label>Brand</label>
                        <input type="text" name="brand" id="brand" value="{{old('brand')}}" required autofocus>
                    </div>
            </div>       

            <div class="row">
                    <div class="from-group ">
                        <label>Descrição</label>
                        <input type="text" name="description" id="description"  value="{{old('description')}}" required autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group ">
                        <label>Tipo de Unidade de Medida</label>
                        <input type="text" name="tipodeunidadedemedida" id="tipodeunidadedemedida"  value="{{old('tipodeunidadedemedida')}}" required autofocus>
                    </div>
            </div>  

            <div class="row">
                    <div class="from-group">
                        <label>Unidade de Medida</label>
                        <input step="0.01" type="number" name="unidadedemedida" id="unidadedemedida" value="{{old('unidadedemedida')}}" >
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group">
                        <label>Stock minimo (unidade)</label>
                        <input step="0.01" type="number" name="stock" id="stock" value="{{old('stock')}}" >
                    </div>
            </div> 

            <div class="row">
                <div class="form-group">
                    <label>Imagem</label>
                    <img src="{{asset('storage/product/default.jpg')}}" style="width:200px; height:auto; clear:both; display:block;  border:1px solid #ddd; margin-bottom:10px;">
                    <input type="file"  name="image">
                </div>
            </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


   
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Novo produto
              </button>
        </h4>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">     
        <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
            <thead >
            <tr>
                <th scope="col">#</th>
                <th scope="col">Imagem</th>
                <th scope="col">Nome</th>
                <th scope="col">Peso</th>
                <th scope="col">Codigo do Produto</th>
                <th scope="col">Codigo de Barras</th>
                <th scope="col">Brand</th>
                <th scope="col">Descrição</th>
                <th scope="col">Tipo de Unidade de Medida</th>
                <th scope="col">Unidade de Medida</th>
                <th scope="col">Stock Minimo</th>
                <th scope="col">Ultima atualização</th>
                <th scope="col">Estado</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($produtos))    
            @foreach($produtos as $cil)
                <tr>
                 <td>{{$cil->id}}</td>
                 <td><img src="{{asset('storage/'.$cil->image)}}" style="width:80px;  clear:both; display:block;  border:1px solid #ddd; margin-bottom:10px;"></td>
                 <td> 

                    <a class="btn btn btn-success btn-xs" href="{{action('ProdutoController@show', $cil->id)}}">
                    <i class="fa fa-pencil fa-fw"></i> {{$cil->name}}
                 </a>
                </td> 
                 <td>{{$cil->peso}}</td>
                 <td>{{$cil->codigoproduto}}</td>
                 <td>{{$cil->codigobarra}}</td>
                 <td>{{$cil->brand}}</td>
                 <td>{{$cil->description}}</td>
                 <td>{{$cil->tipodeunidadedemedida}}</td>
                 <td>{{$cil->unidadedemedida}}</td>
                 <td>{{$cil->stock}}</td>
                 <td>{{$cil->updated_at}}</td>
                 @if($cil->status==1)
                    <td><span class="label label-success">Activado</span></td>
                 @else
                    <td><span class="label label-warning">Desativado</span></td>
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
