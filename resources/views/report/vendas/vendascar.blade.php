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

        <form id="myForm" name="myForm" action="{{url('/report_vendacar_filter')}}" method="post">
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
        <p class="submit col">
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
                <th scope="col">Matricula</th>
                <th scope="col">Data</th>
                <th scope="col">Produto</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($venda))  
 
            @foreach($venda as $cil)
                <tr>
                <td>{{$cil->car_name}}</td> 
                <td>{{$cil->car_sname}}</td> 
                <td>{{$cil->contacto1}} & {{$cil->contacto2}}</td>
                <td>{{$cil->matricula}}</td> 
                <td>{{$cil->created_at}}</td>
                <td>{{$cil->name}}</td>
                <td>{{$cil->quantidade}}</td>
                <td>{{$cil->preco_final}}</td>
                <td>{{$cil->preco_final * $cil->quantidade}}</td>


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
                    //alert($value);
                    console.log($value);
                  $.ajax({
                  url: "{{URL('pagamentocliente')}}",
                  type:'get',
                  data: {codigo_venda:$value},

                  success: function(data) {

                      $por_pargar=data[0]['total_porpagar'];
                      $('.inporpagar').val($por_pargar);
                      $('.codigo_venda_form').val($value);
                      $('.codigo_venda').val($value);
                      console.log($('.inporpagar').val())



                }});

                
            }));
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });

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
