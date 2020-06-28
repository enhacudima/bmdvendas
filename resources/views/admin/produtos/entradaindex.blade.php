@extends('adminlte::page')

@section('title', ' | Entradas')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class=""><a href="{{ url('produto') }}">Produtos</a></li>
        <li class=""><a href="{{ url('produto_entrada') }}">Entradas</a></li>
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
        <h4 class="modal-title">Novo Entrada</h4>
      </div>
      
        <form method="post" action="{{url('store_produto_entrada')}}" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}
            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Produto</label>
                        <select name="produto_id" id="produto_id" class="form-control" value="{{old('produto')}}" required autofocus>
                            <option selected disabled value="">Selecina..</option>
                            @if(isset($produtos))
                            @foreach($produtos as $cil)
                            <option value="{{$cil->id}}"><b>{{$cil->name}}</b> - {{$cil->codigoproduto}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Tipo de unidade de medida</label>
                        <input  id="tipodeunidadedemedida"  disabled="">
                    </div>
            </div>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Unidade de Medida</label>
                        <input  id="unidadedemedida"   disabled="">
                    </div>
            </div>
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Quantidade</label>
                        <input step="any" type="number"  name="quantidade" id="quantidade" class="form-control quantidade" value="{{old('quantidade')}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Custo Total de aquisição</label>
                        <input step="any" type="number"  name="precodecompra" id="precodecompra" class="form-control precodecompra" value="{{old('precodecompra')}}" required autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Margem (%)</label>
                        <input step="any" type="number"  name="margem_per" id="margem_per" class="form-control margem_per" value="{{old('margem_per')}}" required autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Preço de revenda</label>
                        <input step="any" type="number"  name="final_p" id="final_p" class="form-control final_p"  required autofocus >
                    </div>
            </div>  

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Data Expiração</label>
                        <input  type="date" name="data_exp"  class="form-control " value="{{old('data_exp')}}"  >
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Fornecedor</label>
                        <input  type="text" name="fornecedor"  class="form-control " value="{{old('fornecedor')}}"  >
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Telefone Fornecedor</label>
                        <input  type="number" name="telefone"  class="form-control " value="{{old('telefone')}}"  >
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Email Fornecedor</label>
                        <input  type="Email" name="email_fornecedor"  class="form-control " value="{{old('email_fornecedor')}}"  >
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
       <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Nova Entrada
              </button>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">     
        <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
            <thead >
            <tr>
                <th scope="col">#</th>
                <th>Imagem</th>
                <th scope="col">Produto</th>
                <th scope="col">Codigo Produto</th>
                <th scope="col">Tipo de unidade de Medida</th>
                <th scope="col">unidade de Medida</th>
                <th scope="col">Codigo Entrada</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Custo Total de aquisição</th>
                <th scope="col">Margem (%)</th>
                <th scope="col">Quantidade Unitaria</th>
                <th scope="col">Custo unitario</th>
                <th scope="col">Margem</th>
                <th scope="col">Preço de revenda</th>
                <th scope="col">Criado em</th>
                <th scope="col">atualizado em</th>
                <th scope="col">Estado</th>
                <th scope="col">Data Expiração</th>
                <th scope="col">Fornecedor</th>
                <th scope="col">Telefone Fornecedor</th>
                <th scope="col">Email Fornecedor</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($entradas))    
            @foreach($entradas as $cil)
                <tr>
                 <td>{{$cil->id}}</td>
                 <td><img src="{{asset('storage/'.$cil->image)}}" style="width:80px;  clear:both; display:block;  border:1px solid #ddd; margin-bottom:10px;"></td>
                 
                 <td>   
                     <a class="btn btn btn-success btn-xs" href="{{action('ProdutoController@show', $cil->produto_id)}}">
                    <i class="fa fa-pencil fa-fw"></i> {{$cil->name}}
                    </a>
                </td>
                <td> {{$cil->codigoproduto}}</td>
                <td> {{$cil->tipodeunidadedemedida}}</td>
                <td> {{$cil->unidadedemedida}}</td>
                <td>             <a class="btn btn btn-primary btn-xs" href="{{action('ProdutoController@lotshow', $cil->id)}}">
                    <i class="fa fa-pencil fa-fw"></i> {{$cil->lot}}
                 </a>
                </td>  
                 <td>{{$cil->quantidade}}</td>
                 <td>{{number_format($cil->precodecompra, 2, ".", "")}} Mt</td>
                 <td>{{number_format($cil->margem_per, 2, ".", "")}} %</td>
                 <td>{{$cil->quantidade_unitaria}}</td>
                 <td>{{number_format($cil->custo_unitario, 2, ".", "")}} Mt</td>
                 <td>{{number_format($cil->margem, 2, ".", "")}} Mt</td>
                 <td>{{number_format($cil->preco_final, 2, ".", "")}} Mt</td>
                 <td>{{$cil->created_at}}</td>
                 <td>{{$cil->updated_at}}</td>
                 @if($cil->status==1)
                    <td><span class="label label-success">Activado</span></td>
                 @else
                    <td><span class="label label-warning">Desativado</span></td>
                 @endif

                 <td>{{$cil->data_exp}}</td>
                 <td>{{$cil->fornecedor}}</td>
                 <td>{{$cil->fornecedor}}</td>
                 <td>{{$cil->email_fornecedor}}</td>
                </tr>
            @endforeach 
            @endif   
            </tbody>
        </table>
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

    <script>
    $('#produto_id').on('change',function(){
    var id = $(this).val();    
    if(id){
            $.ajax({
               type:"GET",
               url:"{{url('get-produt')}}?id="+id,
               success:function(res){               
                if(res){
                    console.log(res);
                    var unidadedemedida =res.unidadedemedida;
                    var tipodeunidadedemedida =res.tipodeunidadedemedida;
                    $('#unidadedemedida').val(unidadedemedida);
                    $('#tipodeunidadedemedida').val(tipodeunidadedemedida);
                }else{
                   var unidadedemedida='';
                   var tipodeunidadedemedida='';
                }
               }
            });
        }else{
             var unidadedemedida='';
             var tipodeunidadedemedida='';
        }
            
       });

                        


    $('#margem_per').keyup(function(){
        console.log(unidadedemedida);

        var quantidade =   parseFloat($('#quantidade').val());
        var precodecompra =  parseFloat($('#precodecompra').val());
        var margem_per = parseFloat($('#margem_per').val());
        var unidadedemedida = parseFloat($('#unidadedemedida').val());
     
        $custo_unitario=(precodecompra/quantidade/unidadedemedida);
        $margem=$custo_unitario*(margem_per/100);
        $preco_final=$custo_unitario+$margem;

      $('#final_p').val(roundN($preco_final,2)); 

    });


    $('#quantidade').keyup(function(){
        console.log(unidadedemedida);

        var quantidade =   parseFloat($('#quantidade').val());
        var precodecompra =  parseFloat($('#precodecompra').val());
        var margem_per = parseFloat($('#margem_per').val());
        var unidadedemedida = parseFloat($('#unidadedemedida').val());
     
        $custo_unitario=(precodecompra/quantidade/unidadedemedida);
        $margem=$custo_unitario*(margem_per/100);
        $preco_final=$custo_unitario+$margem;

         $('#final_p').val(roundN($preco_final,2)); 

    });


    $('#precodecompra').keyup(function(){
        console.log(unidadedemedida);

        var quantidade =   parseFloat($('#quantidade').val());
        var precodecompra =  parseFloat($('#precodecompra').val());
        var margem_per = parseFloat($('#margem_per').val());
        var unidadedemedida = parseFloat($('#unidadedemedida').val());
     
        $custo_unitario=(precodecompra/quantidade/unidadedemedida);
        $margem=$custo_unitario*(margem_per/100);
        $preco_final=$custo_unitario+$margem;

       $('#final_p').val(roundN($preco_final,2)); 

    });

    $('#final_p').keyup(function(){
        
        var quantidade =   parseFloat($('#quantidade').val());
        var precodecompra =  parseFloat($('#precodecompra').val());
        var custo_unitario = parseFloat($('#final_p').val());
        var unidadedemedida = parseFloat($('#unidadedemedida').val());
     
        var E2=custo_unitario;
        var B2=quantidade*unidadedemedida;
        var C2=precodecompra;

        $preco_final=(((E2*B2)-C2)/C2)*100;

       $('#margem_per').val(roundN($preco_final,5)); 

    });

    function roundN(num,n){
      return parseFloat(Math.round(num * Math.pow(10, n)) /Math.pow(10,n)).toFixed(n);
    }
        
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
