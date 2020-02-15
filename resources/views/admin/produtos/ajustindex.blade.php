@extends('adminlte::page')

@section('title', ' | Cadastro de Nova entrada de Produtos')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Novo Ajuste de Produto
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-4">
        <form method="post" action="{{{url('store_produto_ajuste')}}}" autocomplete="Active" accept-charset="UTF-8" >
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <input   name="tipo" type="hidden" id="tipo" value="ajuste" required autofocus>
            <div class="row">
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
                        <input step="0.01" type="number" name="quantidade_unidade" id="quantidade_unidade" class="form-control" value="{{old('quantidade_unidade')}}" required autofocus>
                    </div>
                </div>

                <div class="row">
                    
                    <div class="from-group col-lg-12">
                        <label>Descrição</label>
                        <textarea type="textarea" name="decricao" id="decricao" class="form-control" value="{{old('decricao')}}"  autofocus></textarea>
                    </div>
                </div>
            <div class="row">

                <div class=" col-lg-12">
                     <label></label>
                    <input class="btn btn-primary" type="submit" value="Submit">
                </div>
            </div>   
            </div> 
            

                
           
        </form>
        

    </div>
    

    <div class="col-lg-8">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Lista de ajustes
        </h4>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">     
        <table id="movimentos" class="table table-striped  table-hover" cellspacing="0" width="100%">
            <thead >
            <tr>
                <th scope="col">#</th>
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
                 <td>             <a class="btn btn btn-success btn-xs" href="{{action('ProdutoController@show', $cil->produto_id)}}">
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
</div>

</div>

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


