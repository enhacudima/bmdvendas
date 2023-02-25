@extends('adminlte::page')

@section('title', ' | Cadastro de Nova entrada de Produtos')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="">Produtos</li>
        <li class="active">Ajuste</li>
    </ol>
@stop

@section('content')


<!--model-->
<div class="modal fade bd-example-modal-lg" id="modal-default"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Novo ajuste</h4>
      </div>

        <form method="post" action="{{{url('store_produto_ajuste')}}}" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}
            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <input   name="tipo" type="hidden" id="tipo" value="ajuste" required autofocus>

                    <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Produto</label>
                        <select name="produto_id" id="produto_id" class="form-control" value="{{old('produto')}}" required autofocus>
                            <option disabled selected ></option>
                            @if(isset($produtos))
                            @foreach($produtos as $cil)
                            <option value="{{$cil->id}}">{{$cil->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                </div>
                <div class="row">

                    <div class="from-group col-lg-6">
                        <label>lot</label>
                        <select name="lot_id" id="lot_id" class="form-control" value="{{old('lot_id')}}" required autofocus>
                        </select>
                    </div>
                    <div class="from-group col-lg-6">
                        <label>Quantidade unit</label>
                        <input step="any" type="number"  name="quantidade_unidade" id="quantidade_unidade" class="form-control" value="{{old('quantidade_unidade')}}" required autofocus>
                    </div>
                </div>

                <div class="row">

                    <div class="from-group col-lg-12">
                        <label>Descrição</label>
                        <textarea type="textarea" name="decricao" id="decricao" class="form-control" value="{{old('decricao')}}"  autofocus></textarea>
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




    <div class="col-lg-12">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Novo Ajuste
              </button>
        </h4>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">
        <table id="movimentos" class="table table-striped  table-hover" cellspacing="0" width="100%">
            <thead >
            <tr>
                <th scope="col">#</th>
                <th>Imagem</th>
                <th scope="col">Produto</th>
                <th scope="col">Lot</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Descricão</th>
                <th scope="col">Criado em</th>
                <th scope="col">atualizado em</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($ajustes))
            @foreach($ajustes as $cil)
                <tr>
                 <td>{{$cil->id}}</td>
                 <td><img src="{{asset('storage/'.$cil->image)}}" style="width:80px;  clear:both; display:block;  border:1px solid #ddd; margin-bottom:10px;"></td>
                 <td>
                 <a class="btn btn btn-success btn-xs" href="{{action('ProdutoController@show', $cil->produto_id)}}">
                    <i class="fa fa-pencil fa-fw"></i> {{$cil->name}}
                 </a>
                </td>
                 <td>{{$cil->lot}}</td>
                 <td>{{$cil->quantidade_unidade}}</td>
                 <td>{{$cil->decricao}}</td>
                 <td>{{$cil->created_at}}</td>
                 <td>{{$cil->updated_at}}</td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
      </div>
        </div>
    </div>
</div>

@section('js')

    <script>

    $(document).ready(function() {
        $('#movimentos').DataTable( {
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



<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

    <script type="text/javascript">

        $('#produto_id').change (function(){


            $value=$(this).val();
            //alert($value);
            $.ajax({
            type : 'get',

            url : '{{URL::to('findlotid')}}',

            data:{'search':$value},

            success:function(data){
            //alert(data)
            $('select[name="lot_id"]').html(data);


                }


        })



        });
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

               <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.material.min.css">

        <style type="text/css">
            .dataTables_wrapper .dt-buttons {
          float:none;
          text-align:center;
          margin-bottom: 30px;
        }
        </style>

@stop
@stop


