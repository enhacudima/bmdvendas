<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{URL::asset('imglogo/logoClinica.png')}}"/>

        <title>Pelos&Patas | Vendas</title>



        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
          <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css">
          <link rel="stylesheet" type="text/css" href="{{asset('src/bootstrap-duallistbox.css')}}">
          <script src="https://code.jquery.com/jquery-3.2.1.min.js"  ></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
          <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
          <script src="{{ asset('src/jquery.bootstrap-duallistbox.js') }}"></script>
          <!--sweetalert-->
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <!--jquery para autocomplet-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>        
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" /> 
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>‌​
        <!--and js-->


        <!--Ajax-->  


        <!-- Styles -->
        <style>
            html, body {
                background-color: #000000;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            
        </style>

        <style type="text/css">
            .center-block {
            padding:10px;
            color:#ec8007
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="row">
                <div class="col-md-12"  style="text-align: center">
                    <div class="center-block"><b><h2>Sala: {{$mesa->name}}; Operador: {{ Auth::user()->name }}</h2></b></div>
                </div>
            </div>
            <hr>

            <div class="row "  style="text-align: center">
                <div class="col-md-6">
                <a class="btn btn-primary " href="{{ url()->previous() }}" style="width: 50%; " ><i class="fa fa-arrow-circle-left"></i> Voltar</a> 
                    
                </div>

                <div class="col-md-6">
                <a class="btn btn-danger " href="#ticket-edit-mesa-modal" data-toggle="modal" data-target="#ticket-edit-mesa-modal" style="width: 50%;"> Finalizar <i class="fa fa-arrow-circle-right"></i>
                </a>
                    
                </div>

            </div>   
            
        
            <hr>


            <div class="row">
<!--havia dual box-->

            <div class="col-md-12 " style="margin-top: 55px; margin-left: 25%">
                <h3>Carrinho</h3>
                <div class="row">
                <form id="carrinhoform" action="#" method="POST">
                    {{ csrf_field() }}
                        <div class="panel-body">

                            <div class="box-body table-responsive no-padding"> 
                                    
                            <div class="input-group control-group increment" style="margin-bottom: 10px" >
                              <input type="text"  id="loanidshow"  name="loanidshow" class="form-control" placeholder="Pesquisar Nome, contact" required autofocus >
                              <div class="input-group-btn" > 
                                <a class="btn btn-success" href="{{url('index_cliente')}}" target="_blanck">+ Add</a>
                              </div>
                              
                            </div>

                                <input type="hidden" id="cliente" name="cliente" value="" />
                                <input type="hidden" id="inputs" name="formtype" value="credito" />
                                <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
                                    <thead >
                                    <tr>
                                        <th scope="col">Descrição do Produto</th>
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
                                            <input style="width: 250px" class="form-control" type="text" name="produt" id="produt"  disabled="" value="{{$value->name}}">
                                        </td> 
                                        <td><input style="width: 100px" class="form-control" step="0.01" type="number" name="preco_final[]" id="preco_final[]" disabled="true" value="{{$value->preco_final}}"></td> 
                                        <td><input style="width: 100px" class="form-control" step="0.01" type="number" name="quantidade[]" id="quantidade[]"  value="{{$value->quantidade}}"></td> 
                                        <td><input style="width: 100px" class="form-control" step="0.01" type="number" name="total[]" id="total[]"  disabled="" value="{{$value->quantidade * $value->preco_final}}"></td>
                                        <td><a type="submit"class="btn btn-danger btn-xs"  data-value="{{$value->id}}" id="delete" href="#">
                                                <i class="fa fa-trash-o fa-lg" ></i> Delete
                                            </a>
                                        </td>


                                        </tr>
                                    @endforeach 

                                    @endif   
                                    </tbody>
                                        <tfoot>
                                          <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td><div class=""><input type="text"  class="total form-control" value="0" name="sum" id="sum" disabled="" /></div></td>
                                          </tr>
                                      </tfoot>
                                </table>
                            </div>    
                            </div>

                @if ($data_mesa)
                <button type="submit" class="row btn btn-primary btn-block " style="margin-top: 10px; width: 40%; max-width: 60%;margin-bottom: 10px"><i class="fa fa-hourglass-start" ></i> Atualizar</button>
                @endif
                </form>
            </div>
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

                    <div class="modal-body">

                        <div class="row">
   

                            <div class="center-block"> 
                                <h3> 
                                Total a Pagar:

                                <input class="form-control total col-md-6"   type="number" name="porpagar" id="porpagar" style="width: auto;" disabled="true" value="">
                                </h3>
                            </div>
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
                                        <input class="form-control valor"  type="number" name="valor[]" value="0" required="">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-3">
                                        <input class="form-control "  type="text" name="fpagamento[]" value="Cartão" disabled="">
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
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="">
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
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="">
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
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="">
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
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="">
                                    </div>
                                </div>
                                <hr>                 

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total Pago:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control " type="number" name="pago" id="pago" value="0" required="" disabled="">
                                    </div>
                                </div>           

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total Por pagar:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control total" type="number" name="ppago" id="ppago" value="0" required="" disabled="">
                                    </div>
                                </div>           

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Troco:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class="form-control" type="number" name="troco" id="troco" value="0" required="" disabled="">
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
                                <input class="btn btn-danger" type="submit" data- value="Creditar ao Cliente">
                                </div>
                    </form>
                        </div>
                    </div>
        </div> 
    
    


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
                                $(".total").val(_total);

                        


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
                    $(".total").val(_total);
                 });

               

            </script>

            <script type="text/javascript">
                
            $(document).ready(function(){

                $('.valor').change(function(){

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
                    var _formtype=($('[name="formtype"]').val());
                    var _cliente=($('[name="cliente"]').val());

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
                                $(".total").val(_total);

                                swal("Pagamento Aceito com Sucesso!", "Você adicionou um pagamento", "success");



                        


                    //alert(data);


                },

                error: function(data){
                    alert("Atenção algo de errado com a sua requizição, verfique se todos campos estão preenchidos. Contacte o administrador");
                }
                });
                     swal("Credito efectuado com sucesso","Tome atenção porque este cliente tem mas um  credito adicional", "success")
                }//end confirmation
                }

                });
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
                                $(".total").val(_total);
                       


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
                        //console.log( ui.item.LoanID ); 
                    }
                });
                })
            </script>
        
    </body>
</html>
