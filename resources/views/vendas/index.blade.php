@extends('adminlte::page')

@section('title',' | Venda')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="">{{$mesa->name}}</li>
        <li class="active">{{ Auth::user()->name }}</li>
    </ol>
@stop

@section('content')
  <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('src/bootstrap-duallistbox.css')}}">
  <script src="{{ asset('src/jquery.bootstrap-duallistbox.js') }}"></script>
  <style type="text/css">
    .bootstrap-duallistbox-container.moveonselect .moveall, .bootstrap-duallistbox-container.moveonselect .removeall {
        width: 95.2%;
        border: 0.88px solid;
    }
}
  </style>
  <!--sweetalert-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        
 <div class="col-md-8">
    <div class="row">
          <div class="box box-default ">
            <div class="box-header with-border">
              <center><h3 class="box-title"><strong><i class="fa fa-fw fa-shopping-bag"></i> Produtos </strong></h3></center>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="input-group">
                    <input type="text" class="form-control" id="find_produtos_stock" placeholder="Pesquise pelo produto">
                    <div class="input-group-addon">
                      <i class="fa fa-search"></i>
                    </div>
                  </div>
                  <hr>
                  <!--inputs-->

                 <input type="" name="formtype" id="formtype" value="venda" hidden="true">
                 <input type="" name="mesa_id" id="mesa_id" value="{{$mesa_id}}" hidden="true">
                 <input name="identificador_de_bulk" id="identificador_de_bulk" class="identificador_de_bulk" hidden="true">
                 <!--end-->
                <table id="produtosVenda" class="table table-striped  table-hover" cellspacing="0" width="100%">
                    <thead>
                        <th width="20%">Image</th>
                        <th width="70%">Detalhes</th>
                        <th width="10%">Ação</th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>

                <form id="demoform" action="#" method="post" style="margin: 5px">
                 {{ csrf_field() }}
              </form> 
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    <div class="row">
         <div class="box box-warning">
           <div class="box-header">
                      <center><h3 class="box-title"><strong><i class="fa fa-fw fa-shopping-cart"></i> Carrinho </strong></h3></center>

            </div>
            <div class="panel-body">

                <div class="box-body table-responsive no-padding">  
                <form id="carrinhoform" action="#" method="POST" style="margin-right: 15px; margin-left: 15px">
                    {{ csrf_field() }}
                        <div class="panel-body">

                            <div class="box-body table-responsive no-padding"> 
  

                                <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
                                    <thead >
                                    <tr>
                                        <th >Descrição do Produto</th>
                                        <th scope="col">Preço.(Mtn)</th>
                                        <th scope="col">Qua.t</th>
                                        <th scope="col">Total.(Mtn)</th>
                                        <th scope="col">Apagar</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($data_mesa))  
                                    @foreach($data_mesa as $key => $value)
                                        <tr>
                                        <td style="width: 400px"> 
                                            <input type="" name="mesa_id" value="{{$mesa_id}}" hidden="true">
                                            <input type="text" id="idbulk" name="idbulk" hidden="true" value="{{$value->identificador_de_bulk}}">
                                            <input step="0.01" type="number" id="id[]" name="id[]" hidden="true" value="{{$value->id}}">
                                            <input style="width: 250px" class="form-control" type="text" name="produt" id="produt"  disabled="" value="{{$value->name}} "></td> 
                                        <td><input style="width: 100px" class="form-control " step="any" type="number"  name="preco_final[]" id="preco_final[]" disabled="true" value="{{$value->preco_final}}"></td> 
                                        <td><input style="width: 100px" class="form-control" step="any" type="number"  name="quantidade[]" id="quantidade[]"  value="{{$value->quantidade}}"></td> 
                                        <td><input style="width: 100px"  class="form-control" step="any" type="number"  name="total[]" id="total[]"  disabled="" value="{{$value->quantidade * $value->preco_final}}"></td>
                                        <td><a type="submit"class="btn btn-block btn-danger btn-flat"  data-value="{{$value->id}}" id="delete" href="#">
                                                <i class="fa fa-trash-o fa-lg" ></i> Eliminar
                                            </a>
                                        </td>


                                        </tr>
                                    @endforeach 

                                    @endif   
                                    </tbody>
                                </table>
                            </div>   
                            </div>
                            <br>

                            @if ($data_mesa)
                            <button type="submit" class="btn btn-block btn-primary btn-flat" style=" margin-bottom: 15px"><i class="fa fa-hourglass-start" ></i> Atualizar</button>
                            @endif 


                </form>

                </div>
            </div>
         </div>
        
    </div>
     
 </div>

<div class="col-md-4">
        <div class="box box-primary">
        <div class="box-header with-border">
            <h5 class="box-title">Cliente</h5>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
             <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                <input  type="text" id="loanidshow"  name="loanidshow"  class="form-control" placeholder="Pesquise pelo nome ou contacto">
                <input type="hidden" id="cliente" name="cliente" value="" />
              </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            
          </div>
        
        </div> 


        <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Resumo</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <p class="help-block">Iva:    <span data-toggle="tooltip" class="badge bg-blue">17%</span></p>
              <p class="help-block">Total IVA:    <span data-toggle="tooltip" class="badge bg-yellow " id="spanTotalVendas" ></p>
              <p class="help-block" style="background: #00ff1f40">Sub Total:    <span data-toggle="tooltip" class="badge bg-green " id="spanTotal" ></span></p>
              <h3 style="border:1px dotted"><i class="fa fa-usd" aria-hidden="true"></i> Total <input style="color: red" type="text"  class="total form-control" value="0" name="sum" id="sum" disabled="" /></h3>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <div class="col-md-4">
                <a class="btn btn-block btn-warning btn-flat" href="#ticket-edit-mesa-modal" data-toggle="modal" data-target="#ticket-edit-mesa-modal" onclick="tipoVendaCash()"><i class="fa fa-money" aria-hidden="true"></i> Complentar </a>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-block btn-warning btn-flat" id="creditar" disabled href="#ticket-edit-mesa-modal" data-toggle="modal" data-target="#ticket-edit-mesa-modal" onclick="tipoVendaCredito()"><i class="fa fa-credit-card" aria-hidden="true"></i> Creditar</button>

            </div>
            <div class="col-md-4">
                 <a class="btn btn-block btn-warning btn-flat" href="#" id="factura"  target="_blanck"><i class="fa fa-print" aria-hidden="true"></i> Factura</a>
            </div>
            
          </div>
        
        </div>  

        <div class="box box-primary">
        <div class="box-header with-border">
            <h5 class="box-title">Ultimas Vendas</h5>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
                <div class="box-body table-responsive no-padding"> 
                    <table id="ultimasVendasTables" class="table table-striped  table-hover" cellspacing="0" width="100%">
                        <thead>
                            <th>Hora</th>
                            <th>Total</th>
                            <th>Pago</th>
                            <th width="13%">A Pagar</th>
                            <th>Troco</th>
                            <th>Informação</th>
                            <th>Imprimir</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        
                    </table>
               </div>
           </div>
          <!-- /.box-body -->

          <div class="box-footer">
            
          </div>
        
        </div> 

</div>

        <!--modal edite Mesa-->
        <div class="modal fade bd-example-modal-lg" id="ticket-edit-mesa-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-mesa-modal-Label">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" >
                    <form method="POST" action="#" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="formfvenda">
                        {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title" id="ticket-edit-mesa-modal-Label">Finalização da Venda </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        
                    </div> 
                    <input type="hidden" id="formtypePagamento" name="formtype"  />

                    <div class="modal-body">

                        <div class="row">
   

                        </div>
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Forma de Pagamento</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Detalhes</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Referência</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Valor</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control "  type="text" name="fpagamento[]" value="Cash" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input  class="form-control " type="text" name="detalhes[]" value="Dinheiro" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0" disabled="" >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor"  step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="Cartão" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <select class="form-control " value="" name="detalhes[]" autofocus required="" >
                                            <option disabled="" value="nan" selected>
                                                Seleciona..
                                            </option>
                                             
                                            <option value="Milennium BIM">
                                                Milennium BIM
                                            </option>    
                                            <option value="BancABC">
                                                BancABC
                                            </option>    
                                            <option value="Barclays">
                                                Barclays
                                            </option>    
                                            <option value="BCI">
                                                BCI
                                            </option>    
                                            <option value="Nosso Banco">
                                                Nosso Banco
                                            </option>    
                                            <option value="BNI">
                                                BNI
                                            </option>    
                                            <option value="Ecobank">
                                                Ecobank
                                            </option>    
                                            <option value="BancABC">
                                                BancABC
                                            </option>    
                                            <option value="CEP">
                                                CEP
                                            </option>    
                                            <option value="Unico">
                                                Unico
                                            </option>    
                                            <option value="Gapi">
                                                Gapi
                                            </option>    
                                            <option value="FNB">
                                                FNB
                                            </option>    
                                            <option value="CapitalBanck">
                                                CapitalBanck
                                            </option>    
                                            <option value="Moza Banco">
                                                Moza Banco
                                            </option>    
                                            <option value="Standard Bank">
                                                Standard Bank
                                            </option>    
                                            <option value="Societe Generale Moçambique">
                                                Societe Generale Moçambique
                                            </option> 

                                             
                                             
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0"  >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="M-PESA" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="detalhes[]" value="Vodacom" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0" >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="Conta Movel" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="detalhes[]" value="BCI" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0"  >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>                  

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="fpagamento[]" value="Outro" disabled="">
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="detalhes[]" value="Outro" >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="text" name="referencia[]" value="0"  >
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control valor" step="any" type="number"  name="valor[]" value="0" required="">
                                    </div>
                                </div>
                                <hr>  

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total a Pagar:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control total "   type="number" step="0.01" name="porpagar" id="porpagar"  disabled="true" value="">
                                    </div>
                                </div> 

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total Pago:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " step="any" type="number"  name="pago" id="pago" value="0" required="" disabled="">
                                    </div>
                                </div>           

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total Por pagar:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control total" step="any" type="number"  name="ppago" id="ppago" value="0" required="" disabled="">
                                    </div>
                                </div>           

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Troco:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control" step="any" type="number"  name="troco" id="troco" value="0" required="" disabled="">
                                    </div>
                                </div>
                              <!-- Custom Tabs -->


                              <!-- nav-tabs-custom -->
                            </div>
                            <!-- /.col -->

                    </div>
                          

                            <div class="clearfix"></div>

                            <div class="modal-footer">

                     
                                
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                <input class="btn btn-primary" type="submit" data- value="Complentar">
                                </div>
                    </form>
                        </div>
                    </div>
        </div> 

     


        <script type="text/javascript">
            var jqxhr = {abort: function () {}};
            $(document).ready(function (){
                ultimasvendas();
                $mesa_id=$('#mesa_id').val();
                $formtype=$('#formtype').val();
                $.ajax({
                    url:"{{url('vendas/find/bulck')}}",
                    type:'Get',
                    data:{formtype:$formtype,mesa_id:$mesa_id},
                    success: function(data){

                        $('.identificador_de_bulk').val(data.identificador_de_bulk);
                        var link = document.getElementById("factura");
                        var _cliente=($('[id="cliente"]').val()); 
                        if(_cliente){
                        var url="{{ url('venda/facturaVenda/') }}"+'/'+data.identificador_de_bulk+'/'+_cliente;   
                        }else{
                        var url="{{ url('venda/factura/') }}"+'/'+data.identificador_de_bulk;    
                        }
                        
                        link.setAttribute("href", url);
                    },
                    error: function (error){
                        console.log(error);
                    }
                });


            }
        );
            function getIdBulck(){
                $mesa_id=$('#mesa_id').val();
                $formtype=$('#formtype').val();
                $.ajax({
                    url:"{{url('vendas/find/bulck')}}",
                    type:'Get',
                    data:{formtype:$formtype,mesa_id:$mesa_id},
                    success: function(data){

                        $('.identificador_de_bulk').val(data.identificador_de_bulk);
                    },
                    error: function (error){
                        console.log(error);
                    }
                });

            }


        </script>


            <script>

              
              function produtostockadd($id) {
                $mesa_id=($('[name="mesa_id"]').val());
                $formtype=($('[name="formtype"]').val());
                $idbulk=($('[name="identificador_de_bulk"]').val());

                $.ajax({
                  url: "{{URL('saveselection')}}",
                  type:'POST',
                  data: {produt_id:$id,mesa_id:$mesa_id,formtype:$formtype,idbulk:$idbulk},
                  success: function(data) {
                        $('#reclatodas > tbody') .html(data);

                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                            $(".total").val( Number(_total).toFixed(2));
                            
                            document.getElementById("spanTotal").innerHTML= Number(_total-(_total*0.17)).toFixed(2);
                            document.getElementById("spanTotalVendas").innerHTML=Number(_total*0.17).toFixed(2);
                            getIdBulck();
                  }});
                return false;
              };
            </script>
            <script type="text/javascript">
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
            </script>

            <script type="text/javascript">
                //atualizando os dados na tabela temporaria 
                $("#carrinhoform").submit(function(e){
                    e.preventDefault();

                    var id = $('[name="id[]"]');
                    var quantidade = $('[name="quantidade[]"]');
                    $idbulk=($('[name="idbulk"]').val());
                    $mesa_id=($('[name="mesa_id"]').val());
                    var _id = [];
                    var _quantidade=[];


                    for (var i = 0; i < id.length; i++) {
                        _id.push($(id).eq(i).val());
                        _quantidade.push($(quantidade).eq(i).val())
                        
                    }
                    //alert(JSON.stringify(p));//or alert(p)
                    //alert(_id+''+_quantidade+''+idbulk);   

                $.ajax({
                  url: "{{URL('atualizarvendatemp')}}",
                  type:'POST',
                  data: {idbulk:$idbulk,mesa_id:$mesa_id,id:_id,quantidade:_quantidade},

                  success: function(data) {
                        $('#reclatodas > tbody') .html(data);

                            //retornando total
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val( Number(_total).toFixed(2));                            
                                document.getElementById("spanTotal").innerHTML= Number(_total-(_total*0.17)).toFixed(2);
                                document.getElementById("spanTotalVendas").innerHTML=Number(_total*0.17).toFixed(2);

                                //produtoStock()

                        


                    //alert(data);


                }});


                });
            </script>

            <script type="text/javascript">
                //Atualizando o preço final do carrinho
                $(window).on('load', function() {
                 // code here

                 var total=$('[name="total[]"]')
                 var __total=[];
                 var sum=0;
                 var _total=0;

                 for (var i=0;i<total.length;i++){
                    __total=$(total).eq(i).val();
                    _total=parseFloat(__total)+parseFloat(_total);
                 }
                //alert(parseFloat(_total))
                    $(".total").val( Number(_total).toFixed(2));                            
                    document.getElementById("spanTotal").innerHTML= Number(_total-(_total*0.17)).toFixed(2);
                    document.getElementById("spanTotalVendas").innerHTML=Number(_total*0.17).toFixed(2);
                    //produtoStock()
                 });

               

            </script>

            <script type="text/javascript">
                
            $(document).ready(function(){

                $('.valor').keyup(function(){

                     var total=$('[name="valor[]"]')
                     var __total=[];
                     var sum=0;
                     var _total=0;

                     for (var i=0;i<total.length;i++){
                        __total=$(total).eq(i).val();
                        _total=parseFloat(__total)+parseFloat(_total);
                     }
                    //alert(parseFloat(_total))
                    $("#pago").val(_total);

                    var porpagar=$('[name="porpagar"]').val();
                    var realporpagar=parseFloat(porpagar)-parseFloat(_total);
                    if (realporpagar<=0) {
                        var troco=realporpagar;
                        var realporpagar=0;
                        $("#troco").val(troco);

                    }


                        $("#ppago").val(realporpagar);

                    });
            });
            </script>


            <script type="text/javascript">
                //add venda

                $("#credito").click(function(e){
                    e.preventDefault();
                    $mesa_id=($('[name="mesa_id"]').val());

                    window.location.replace("{{ url('vendascreditoindex',$mesa_id) }}");//here double curly bracket

                });
            </script>




            <script type="text/javascript">
                //add venda
                $("#formfvenda").submit(function(e){
                    e.preventDefault();


                    var fpagamento = $('[name="fpagamento[]"]');
                    var detalhes = $('[name="detalhes[]"]');
                    var referencia = $('[name="referencia[]"]');
                    var valor = $('[name="valor[]"]');
                    $mesa_id=($('[name="mesa_id"]').val());
                    $porpagar=($('[name="porpagar"]').val());
                    $pago=($('[name="pago"]').val());
                    $ppago=($('[name="ppago"]').val());
                    $troco=($('[name="troco"]').val());
                    var _cliente=($('[name="cliente"]').val()); 
                    //var $formtype=($('[name="formtype"]').val());
                    var formtypePagamento=($('#formtypePagamento').val());
                    var $formtype=($('#formtypePagamento').val());

                    var _fpagamento = [];
                    var _detalhes=[];
                    var _referencia = [];
                    var _valor=[];


                    for (var i = 0; i < fpagamento.length; i++) {
                        _fpagamento.push($(fpagamento).eq(i).val());
                        _detalhes.push($(detalhes).eq(i).val())
                        _referencia.push($(referencia).eq(i).val());
                        _valor.push($(valor).eq(i).val())
                        
                    }
                if (formtypePagamento=='credito') {creditoSave();}

                if (confirm("Tens a certeza que pretendes Efectuar o pagamento : " + $pago + "?"))
                {   
                 
                if ($ppago==0 || $pago==$porpagar) 
                {
                $.ajax({
                  url: "{{URL('efectuarpagamento')}}",
                  type:'POST',
                  data: {fpagamento:_fpagamento,detalhes:_detalhes,referencia:_referencia,valor:_valor,mesa_id:$mesa_id,porpagar:$porpagar,pago:$pago,ppago:$ppago,_troco:$troco,formtype:$formtype,cliente:_cliente},

                  success: function(data) {
                        //zerando os campos
                        $porpagar=($('[name="porpagar"]').val(0));
                        $pago=($('[name="pago"]').val(0));
                        $ppago=($('[name="ppago"]').val(0));
                        $troco=($('[name="troco"]').val(0));
                        var referencia = $('[name="referencia[]"]').val(0);
                        var valor = $('[name="valor[]"]').val(0);

                        $('#reclatodas > tbody') .html(data);


                            //retornando total
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val( Number(_total).toFixed(2));                            
                                document.getElementById("spanTotal").innerHTML= Number(_total-(_total*0.17)).toFixed(2);
                                document.getElementById("spanTotalVendas").innerHTML=Number(_total*0.17).toFixed(2);
                                //produtoStock();
                                swal("Pagamento Aceito com Sucesso!", "Você adicionou um pagamento", "success");



                        


                    //alert(data);


                },

                error: function(data){
                    alert("Atenção algo de errado com a sua requizição, contacte o administrador");
                }
                });
                }else{
                    swal("Valores não aceites","Verfica se o valor a pagar é igual a zerro (0) ou o valor pago é diferente de zerro (0)", "error")

                };//end if pago =0

                }//end confirmation


                });
                //venda acredito save
                function creditoSave(){
                    var fpagamento = $('[name="fpagamento[]"]');
                    var detalhes = $('[name="detalhes[]"]');
                    var referencia = $('[name="referencia[]"]');
                    var valor = $('[name="valor[]"]');
                    $mesa_id=($('[name="mesa_id"]').val());
                    $porpagar=($('[name="porpagar"]').val());
                    $pago=($('[name="pago"]').val());
                    $ppago=($('[name="ppago"]').val());
                    $troco=($('[name="troco"]').val());
                    //var _formtype=($('[name="formtype"]').val());
                    var _cliente=($('[name="cliente"]').val());
                    var _formtype=($('#formtypePagamento').val());

                    var _fpagamento = [];
                    var _detalhes=[];
                    var _referencia = [];
                    var _valor=[];




                    for (var i = 0; i < fpagamento.length; i++) {
                        _fpagamento.push($(fpagamento).eq(i).val());
                        _detalhes.push($(detalhes).eq(i).val())
                        _referencia.push($(referencia).eq(i).val());
                        _valor.push($(valor).eq(i).val())
                        
                    }

                    

           
                if (!_cliente) {
                   swal("Cliente não verificado!", "Verifica se existe um cliente selecionado, ou pesquise pelos nomes dos clientes aptos à contrair credito.", "error");
                }else{

                if (confirm("Tens a certeza que pretendes Efectuar o credito : " + $porpagar + "?"))
                {  



                 
                
                $.ajax({
                  url: "{{URL('efectuarpagamento')}}",
                  type:'POST',
                  data: {fpagamento:_fpagamento,detalhes:_detalhes,referencia:_referencia,valor:_valor,mesa_id:$mesa_id,porpagar:$porpagar,pago:$pago,ppago:$ppago,_troco:$troco,cliente:_cliente,formtype:_formtype},

                  success: function(data) {
                        //zerando os campos
                        $porpagar=($('[name="porpagar"]').val(0));
                        $pago=($('[name="pago"]').val(0));
                        $ppago=($('[name="ppago"]').val(0));
                        $troco=($('[name="troco"]').val(0));
                        var referencia = $('[name="referencia[]"]').val(0);
                        var valor = $('[name="valor[]"]').val(0);

                        $('#reclatodas > tbody') .html(data);


                            //retornando total
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val( Number(_total).toFixed(2));                            
                                document.getElementById("spanTotal").innerHTML= Number(_total-(_total*0.17)).toFixed(2);
                                document.getElementById("spanTotalVendas").innerHTML=Number(_total*0.17).toFixed(2);
                                //produtoStock();
                                swal("Pagamento Aceito com Sucesso!", "Você adicionou um pagamento a credito com sucesso", "success");



                        


                    //alert(data);


                },

                error: function(data){
                    alert("Atenção algo de errado com a sua requizição, verfique se todos campos estão preenchidos. Contacte o administrador");
                }
                });
                     swal("Credito efectuado com sucesso","Tome atenção porque este cliente tem mas um  credito adicional", "success")
                }//end confirmation
                }
                }
            </script>

            <script type="text/javascript">
            $(document).on('click', '#delete',(function() {//using delegaction to send event on dynamic datatable


                    $value=$(this).data("value");
                    //alert($value);
                    console.log($value);
                if (confirm("Clique 'Ok' para continuar"))
                {
                  $.ajax({
                  url: "{{URL('apagalinha')}}",
                  type:'post',
                  data: {linha_id:$value},

                  success: function(data) {
                    $('#reclatodas > tbody') .html(data);


                            //retornando total
                             var total=$('[name="total[]"]')
                             var __total=[];
                             var sum=0;
                             var _total=0;

                             for (var i=0;i<total.length;i++){
                                __total=$(total).eq(i).val();
                                _total=parseFloat(__total)+parseFloat(_total);
                             }
                            //alert(parseFloat(_total))
                                $(".total").val( Number(_total).toFixed(2));                            
                                document.getElementById("spanTotal").innerHTML= Number(_total-(_total*0.17)).toFixed(2);
                                document.getElementById("spanTotalVendas").innerHTML=Number(_total*0.17).toFixed(2);
                                //produtoStock();


                }}
                );

                }    


                
            }));
            </script>

            <script>

                $(document).ready(function() {
                $('#loanidshow').autocomplete({
                    

                    delay: 500,// this is in milliseconds

                    minLength: 2,

                    source: function(request, response) {

                        $.getJSON("{{url('searchcliente')}}", {
                            search: request.term,
                        }, function(data) {
                            response(data);
                        });


                    },
                    focus: function(event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
                    },
                    select: function(event, ui) {
                        // prevent autocomplete from updating the textbox
                        event.preventDefault();
         
                        $('input[name="loanidshow"]').val(ui.item.label);
                        $('input[name="cliente"]').val(ui.item.id);
                        document.getElementById("creditar").disabled = false;
                        //set id cliente on link
                        var identificador_de_bulk = $('.identificador_de_bulk').val();
                        var link = document.getElementById("factura");
                        var _cliente=($('[name="cliente"]').val());
                        if(_cliente){
                        var url="{{ url('venda/facturaVenda/') }}"+'/'+identificador_de_bulk+'/'+_cliente;   
                        }else{
                        var url="{{ url('venda/factura/') }}"+'/'+identificador_de_bulk;    
                        }
                        
                        link.setAttribute("href", url);
                        //console.log( ui.item.LoanID ); 
                    }
                });
                })
            </script>
            <script type="text/javascript">
                function tipoVendaCredito(){
                   $('#formtypePagamento').val('credito');
                }
            </script>
            <script type="text/javascript">
                function tipoVendaCash(){
                   $('#formtypePagamento').val('venda');
                }
            </script>

            <script type="text/javascript">
            $(document).ready(function(){   
            $('#find_produtos_stock').keyup(function(){
                var value = $('#find_produtos_stock').val();
                 
                jqxhr.abort();
                jqxhr =$.ajax({
                  url: "{{URL('vendas/produtos/stock')}}",
                  type:'get',
                  data: {key:value},
                  success: function(data) {
                    $('#produtosVenda > tbody') .html(data);



                }});
            }); 
            }) 
            </script>
            <script type="text/javascript">
                function ultimasvendas(){
                $.ajax({
                    url:"{{url('vendas/ultimas/vendas')}}",
                    type:'get',
                    success:function(data){
                        $(".ultimas_vendas").empty();
                         var corpo=[];
                        $.each(data, function (key, value) {
                             corpo[key]='<tr><td>'+value.created_at+'</td><td> <span data-toggle="tooltip" title="'+value.total_venda+'" class="badge bg-yellow " > '+value.total_venda+'</span></td><td><span data-toggle="tooltip" title="'+value.total_pago+'" class="badge bg-yellow " > '+value.total_pago+' </span> </td><td><span data-toggle="tooltip" title="'+value.total_porpagar+'" class="badge bg-yellow " > '+value.total_porpagar+' </span> </td><td><span data-toggle="tooltip"  title="'+value.total_troco+'" class="badge bg-yellow " > '+value.total_troco+'</span></td><td><a class="btn  btn-info btn-flat btn-xs" href="{{url("vendas/ultima")}}'+'/'+value.codigo_venda+'"> <i class="fa fa-info-circle" aria-hidden="true"></i></a></td><td><a target="_blanck" class="btn  btn-info btn-flat btn-xs" href="{{url("vendas/ultima/print")}}'+'/'+value.codigo_venda+'"><i class="fa fa-print" aria-hidden="true"></i>  </a></td></tr>';
                        });
                        $('#ultimasVendasTables > tbody') .html(corpo);  
                    }
                })}
            </script>
@stop
