@extends('adminlte::page')

@section('title', ' | Report Venda a Credito')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Report Venda a credito
        </h4>
    </div>

    <div class="panel-body">

        <form id="myForm" name="myForm" action="{{url('/report_vendacredito_filter')}}" method="post">
                @csrf
                {{ csrf_field() }}
    <div class="">
        <div class="form-group col-sm-2">
                <label >Data Inicio</label>

                        <input class="form-control" type="date" tyle="width: 100%"  id="inicio"  name="inicio" required autofocus>


        </div>

        <div class="form-group  col-sm-2 ">
                <label >Data Fim</label>

                        <input class="form-control" type="date" tyle="width: 100%"  id="fim"  name="fim" required autofocus >


        </div>

        </div>

        <div class="">
        <p class="submit col" style="padding-top: 25px">
            <strong>
            <button type="submit" class="btnEmidio btn btn-primary bord0" value="1" id="gravar">Atualizar </button>
            </strong>
        </p>

        </div>


    <input hidden="" htype="" name="idusuario" id="idusuario" value="{{ Auth::user()->id }}">



    </form>



    <div class="col-lg-12">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Vendas a Credito
        </h4>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">
        <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
            <thead >
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Apelido</th>
                <th scope="col">Contacto</th>
                <th scope="col">Data</th>
                <th scope="col">Criado por</th>
                <th scope="col">Detalhes</th>
                <th scope="col">Total da venda</th>
                <th scope="col">Total Pago</th>
                <th scope="col">Total Por Pagar</th>
                <th scope="col">Total de Troco</th>
                <th scope="col">Codigo de Pagamento</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($venda))

            @foreach($venda as $cil)
                <tr>
                <td>{{$cil->cname}}</td>
                <td>{{$cil->clname}}</td>
                <td>{{$cil->contacto1}} & {{$cil->contacto2}}</td>
                <td>{{$cil->created_at}}</td>
                <td>{{$cil->uname}}</td>
                <td>
                <a class="btn btn btn-success btn-xs" href="#ticket-edit-mesa-modal" type="submit" data-toggle="modal" data-target="#ticket-edit-mesa-modal"  data-value="{{$cil->codigo_venda}}" id="droplist">
                    <i class="fa fa-eye fa-fw"></i>
                </a>
                <a id="creditar" class="btn btn btn-danger btn-xs" href="#ticket-edit-sale-modal" data-toggle="modal" data-target="#ticket-edit-sale-modal"  data-value="{{$cil->codigo_venda}}">
                    <i class="fa fa-free-code-camp fa-fw"></i>
                </a>
                </td>
                <td>{{$cil->total_venda}}</td>
                <td>{{$cil->total_pago}}</td>
                <td>{{$cil->total_porpagar}}</td>
                <td>{{$cil->total_troco}}</td>
                <td>{{$cil->codigo_venda}}</td>

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



        <!--modal edite Mesa-->
        <div class="modal fade bd-example-modal-lg" id="ticket-edit-mesa-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-mesa-modal-Label">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="ticket-edit-mesa-modal-Label">Detalhes </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                              <!-- Custom Tabs -->
                              <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#tab_1" data-toggle="tab">Lista de Pedidos</a></li>
                                  <li><a href="#tab_2" data-toggle="tab">Contas a Pagar</a></li>
                                  <li><a href="#tab_3" data-toggle="tab">Contas Pagas</a></li>
                                </ul>
                                <div class="tab-content">
                                  <div class="tab-pane active" id="tab_1">

                                  <div class="">
                                  <table id="example" class="display nowrap" style="width:100%">
                                      <thead>
                                          <tr>
                                              <th>Produto</th>
                                              <th>Preço (Unit)</th>
                                              <th>Quantidade</th>
                                              <th>Preço final</th>
                                          </tr>
                                      </thead>
                                      <tbody>

                                      </tbody>
                                      <tfoot>
                                          <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td><div class="col-md-4"><input type="text" id="grdtot" class="grdtot form-control" value="0" name="" disabled="" /></div></td>
                                          </tr>
                                      </tfoot>
                                  </table>
                                  </div>


                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="tab_2">
                                  </div>
                                  <!-- /.tab-pane -->
                                  <div class="tab-pane" id="tab_3">
                                  </div>
                                  <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                              </div>
                              <!-- nav-tabs-custom -->
                            </div>
                            <!-- /.col -->

                    </div>


                            <div class="clearfix"></div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
        </div>

        </div>
       <!--modal edite Mesa-->
        <div class="modal fade bd-example-modal-lg" id="ticket-edit-sale-modal" tabindex="-1" role="dialog" aria-labelledby="ticket-edit-sale-modal-Label">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content" >
                    <form method="POST" action="#" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data" id="formfvenda">
                        {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title" id="ticket-edit-sale-modal-Label">Liquidação da Divida</h4>
                        <input class=" codigo_venda_form" disabled="" >
                        <input class=" codigo_venda"  name="codigo_venda" hidden="" disabled="" required="" >
                        <input type="" name="formtype" value="credito" hidden="true">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>

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
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="" step="any">
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
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="" step="any">
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
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required="" step="any">
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
                                        <input class="form-control valor" type="number" name="valor[]" value="0" required=""  step="any">
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
                                        <input class="form-control " type="number" name="pago" id="pago" value="0" required="" disabled="" step="any">
                                    </div>
                                </div>

                                <div class="row" style="margin-right: 4px;margin-bottom: 3px">
                                    <div class="col-md-6">
                                    </div>

                                    <div class="col-md-3">
                                       <label>Total Por pagar:</label>
                                    </div>

                                    <div class="col-md-3">
                                        <input class=" inporpagar" type="number" name="inporpagar" id="inporpagar" hidden="" disabled="" >
                                        <input class="form-control total inporpagar" type="number" name="ppago" id="ppago" value="0" required="" disabled="">
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
                                <input class="btn btn-danger" type="submit" data- value="Debtar ao Cliente">
                                </div>
                    </form>
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
            //"order": [[ 0, "desc" ]],
            responsive: true,
            dom: 'lfBrtip',
            buttons: [
                'excel', 'print'
            ],

        } );
    } );
    </script>


                <!-- JavaScript de Popup de List -->
        <script>
            var jqxhr = {abort: function () {}};

           $(document).on('click', '#droplist',(function() {//using delegaction to send event on dynamic datatable


                    $value=$(this).data("value");
                    //alert($value);
                    console.log($value);
                  $.ajax({
                  url: "{{URL('listapedidoscliente')}}",
                  type:'get',
                  data: {codigo_venda:$value},

                  success: function(data) {
                      $('#example>tbody') .html(data);


                    //retornando total
                      if (data) {

                      var $tblrows = $("#example tbody tr");
                        $tblrows.each(function (index) {
                            var $tblrow = $(this);

                            $tblrow.find('.subtot').val

                               var grandTotal = 0;
                                $(".subtot").each(function () {
                                    var stval = parseFloat($(this).val());
                                    grandTotal += isNaN(stval) ? 0 : stval;
                                });


                              $('.grdtot').val(grandTotal.toFixed(2));

                        });
                      } else{
                        $('.grdtot').val(0)
                      }


                }});


            }));
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

        </script>

        <script>
            var jqxhr = {abort: function () {}};

           $(document).on('click', '#creditar',(function() {//using delegaction to send event on dynamic datatable
                  $value=$(this).data("value");
                  $.ajax({
                  url: "{{URL('pagamentocliente')}}",
                  type:'get',
                  data: {codigo_venda:$value},

                  success: function(data) {

                      $por_pargar=data['total_porpagar'];
                      $('.inporpagar').val($por_pargar);
                      $('.codigo_venda_form').val($value);
                      $('.codigo_venda').val($value);
                      console.log(data)
                }});


            }));
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

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

                    var porpagar=$('[name="inporpagar"]').val();
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
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });



            $("#formfvenda").submit(function(e){
                    e.preventDefault();


                    var fpagamento = $('[name="fpagamento[]"]');
                    var detalhes = $('[name="detalhes[]"]');
                    var referencia = $('[name="referencia[]"]');
                    var valor = $('[name="valor[]"]');
                    $mesa_id=($('[name="mesa_id"]').val());
                    $porpagar=($('[name="inporpagar"]').val());
                    $pago=($('[name="pago"]').val());
                    $ppago=($('[name="ppago"]').val());
                    $troco=($('[name="troco"]').val());
                    var _formtype=($('[name="formtype"]').val());
                    var _codigo_venda=($('[name="codigo_venda"]').val());

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


                if (confirm("Tens a certeza que pretendes Efectuar o credito : " + $porpagar + "?"))
                {



                $.ajax({
                  url: "{{URL('efectuarpagamentocredito')}}",
                  type:'POST',
                  data: {fpagamento:_fpagamento,detalhes:_detalhes,referencia:_referencia,valor:_valor,mesa_id:$mesa_id,porpagar:$porpagar,pago:$pago,ppago:$ppago,_troco:$troco,codigo_venda:_codigo_venda,formtype:_formtype, _token: '{{csrf_token()}}'},

                  success: function(data) {
                        //zerando os campos
                        $porpagar=($('[name="porpagar"]').val(0));
                        $pago=($('[name="pago"]').val(0));
                        $ppago=($('[name="ppago"]').val(0));
                        $troco=($('[name="troco"]').val(0));
                        var referencia = $('[name="referencia[]"]').val(0);
                        var valor = $('[name="valor[]"]').val(0);
                        $(".total").val(0);


                        swal("Credito efectuado com sucesso","Tome atenção porque este cliente tem mas um  credito adicional", "info")

                         window.location.replace("{{ url('report_vendacredito') }}");//here double curly bracket



                },

                error: function(data){
                    alert("Atenção algo de errado com a sua requizição, verfique se todos campos estão preenchidos. Contacte o administrador");
                }
                });

                }//end confirmation


                });
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





    <!--Out radius bottons-->
    <style type="text/css">

    /*Global*/

        .bord0 {
        border-radius: 0;
        }


    </style>
@stop
