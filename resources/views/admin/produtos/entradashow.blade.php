@extends('adminlte::page')

@section('title', ' | Editar entrada de Produto')

@section('content_header')
    <h1>Produtos|Entradas|Show</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Editar entrada de Produto lote: {{$produtos[0]->lot}}
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-3  col-lg-offset-4">
        <form method="post" action="{{{url('produto/entrada/update')}}}" autocomplete="Active" accept-charset="UTF-8" >
            {{ csrf_field() }}

            <input   name="idusuario" type="hidden" id="idusuario" value="{{ Auth::user()->id }}" required autofocus>
            <input   name="id" type="hidden" id="id" value="{{$produtos[0]->id}}" required autofocus>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Produto</label>
                        <select name="produto_id" id="produto_id" class="form-control" value="{{old('produto')}}" required autofocus>
                            @if(isset($produtos))
                          
                            <option value="{{$produtos[0]->produto_id}}">{{$produtos[0]->name}}</option>
                        
                            @endif
                        </select>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Quantidade</label>
                        <input type="number" name="quantidade" id="quantidade" class="form-control quantidade" value="{{$produtos[0]->quantidade}}" required autofocus>
                    </div>
            </div> 
            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Preço de Compra</label>
                        <input type="number" name="precodecompra" id="precodecompra" class="form-control precodecompra" value="{{$produtos[0]->precodecompra}}"  autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Margem (%)</label>
                        <input type="number" name="margem_per" id="margem_per" class="form-control" value="{{$produtos[0]->margem_per}}" required autofocus>
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Preço final</label>
                        <input step="0.01" type="number"  id="final_p" class="form-control final_p"  required autofocus disabled="">
                    </div>
            </div>

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Data Expiração</label>
                        <input  type="date" name="data_exp"  class="form-control " value="{{$produtos[0]->data_exp}}"  >
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Fornecedor</label>
                        <input  type="text" name="fornecedor"  class="form-control " value="{{$produtos[0]->fornecedor}}"  >
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Telefone Fornecedor</label>
                        <input  type="number" name="telefone"  class="form-control " value="{{$produtos[0]->telefone}}"  >
                    </div>
            </div> 

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Email Fornecedor</label>
                        <input  type="Email" name="email_fornecedor"  class="form-control " value="{{$produtos[0]->email_fornecedor}}"  >
                    </div>
            </div>       

            <div class="row">
                    <div class="from-group col-lg-12">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control" value="{{$produtos[0]->status}}" required autofocus>
                            @if($produtos[0]->status==0)
                            <option selected="" value="{{$produtos[0]->status}}">Desativado </option>
                            <option  value="1">Ativado </option> 
                            @elseif($produtos[0]->status=1)
                            <option selected="" value="{{$produtos[0]->status}}">Ativado </option> 
                            <option  value="0">Desativado </option> 
                           
                            @endif
                        </select>

                    </div>
            </div> 
            <div class="row">

                <div class="from-group text-right col-md-12">
                     <label></label>
                    <input class="btn btn-primary" type="submit" value="Atualizar">
                </div>
            </div>   
                
           
        </form>
        

    </div>
    
</div>

</div>
<input type="hidden" id="unidadedemedida" value="{{$produtos[0]->unidadedemedida}}">
    <script>
         
    $(document).ready(function() {
        $('#reclatodas').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
                }
            ],
            "order": [[ 11, "desc" ]],
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
                    var unidadedemedida =res;
                    $('#unidadedemedida').val(res);
                }else{
                   var unidadedemedida='';
                }
               }
            });
        }else{
             var unidadedemedida='';
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

    function roundN(num,n){
      return parseFloat(Math.round(num * Math.pow(10, n)) /Math.pow(10,n)).toFixed(n);
    }
    
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
@stop
