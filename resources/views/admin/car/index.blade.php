@extends('adminlte::page')

@section('title', ' | Banho')

@section('content_header')   
 <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="">{{$mesa->name}}</li>
        <li class="">{{ Auth::user()->name }}</li>
        <li class="active">Lista de Espera</li>
    </ol>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--sweetalert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--model-->
<div class="modal fade bd-example-modal-lg" id="modal-default"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Pacientes</h4>
      </div>
      
        <form method="post" action="" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}
            <div class="box-body table-responsive no-padding">      
            <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
                <thead >
                <tr>     
                    <th scope="col">Caderneta</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Contacto</th>
                    <th scope="col">Animal</th> 
                    <th scope="col">Acção</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($car))    
                @foreach($car as $cil)
                    <tr>
                     <td>{{$cil->caderneta}}</td> 
                     <td>{{$cil->cliente->nome}} {{$cil->cliente->apelido}}</td>
                     <td>{{$cil->cliente->contacto1}} {{$cil->cliente->contacto2}}</td>
                     <td>{{$cil->nome}}</td>
                     <td> 

                        <a class="btn btn btn-success btn-xs"   href="{{url('cartemp', [$cil->id,$mesa_id,Auth::user()->id])}}">
                              <i class="fa fa-chevron-right" aria-hidden="true"></i>
                        </a>
                     </td>
                    </tr>
                @endforeach 
                @endif   
                </tbody>
            </table>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!--model-->
<div class="modal fade bd-example-modal-lg" id="modal-default-mesa"  tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Seleciona Balcão Para Facturação</h4>
      </div>
      
        <form method="post" action="" autocomplete="Active" accept-charset="UTF-8" enctype="multipart/form-data" style="margin:15px">
            <div class="modal-body">
            {{ csrf_field() }}

                <div class="row">
                <div class="from-group col-lg-12">
                        <label>Tipo de Banho</label>
                        <select name="tipo_banho" id="tipo_banho" class="form-control" value="{{old('tipo_banho')}}" required autofocus>
                            <option disabled selected >Seleciona o tipo de banho..</option>
                            @if(isset($tipo_banho))
                                @foreach($tipo_banho as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">      
                <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
                    <thead >
                    <tr>     
                        <th scope="col">Discrição</th>
                        <th scope="col">Estado</th> 
                        <th scope="col">Acção</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($mesas))    
                    @foreach($mesas as $cil)
                        <tr>
                         <td>{{$cil->name}}</td> 
                         <td>
                            @if($cil->status==0)
                                Ocupada
                            @else
                                Livre
                            @endif
                         </td>
                         <td> 
                            @if($cil->status!=0)
                            <a class="btn btn btn-success btn-xs"   onclick="releaseVenda('{{$cil->id}}','{{$cil->name}}')" href="#">
                                  <i class="fa fa-chevron-right" aria-hidden="true"></i>
                            </a>
                            @endif
                         </td>
                        </tr>
                    @endforeach 
                    @endif   
                    </tbody>
                </table>
                </div>
        
         </div>  
          <small id="fileHelp" class="form-text text-muted"><a style="color: red">*</a>Por favor verifica se existe um balcão livre</small>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">
                Lista de Paciente
        </button>
    </div>

    <div class="panel-body">

    <div class="box-body table-responsive no-padding">     
    <table id="lista" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>     
            <th scope="col">Caderneta</th>
            <th scope="col">Cliente</th>
            <th scope="col">Contacto</th>
            <th scope="col">Animal</th>
            <th scope="col">Data</th>
            <th scope="col">Venda</th>
            <th scope="col">Eliminar</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($car_temp))    
        @foreach($car_temp as $cil)
            <tr>
             <td>{{$cil->paciente->caderneta}}</td> 
             <td>{{$cil->paciente->cliente->nome}} {{$cil->paciente->cliente->apelido}}</td>
             <td>{{$cil->paciente->cliente->contacto1}} {{$cil->paciente->cliente->contacto2}}</td>
             <td>{{$cil->paciente->especie}}-{{$cil->paciente->raca}}</td>
             <td>{{$cil->updated_at->diffForHumans()}}</td>

             <td> 

                <a class="btn btn btn-success btn-xs"   href="#" data-value="[{{$cil->car_id}},{{$cil->id}}]" id="venda" data-toggle="modal" data-target="#modal-default-mesa">
                    <i class="fa fa-money fa-lg"></i>
                </a>
             </td>
            <td><a type="submit"class="btn btn-danger btn-xs"  data-value="{{$cil->id}}" id="delete" href="#">
                    <i class="fa fa-trash-o fa-lg" ></i>
                </a>
            </td>
            </tr>
        @endforeach 
        @endif   
        </tbody>
    </table>
    </div>
        </div>
    </div>
    <input type="text" name="pacienteLinha" id="pacienteLinha" hidden="">
    <input type="text" name="pacienteLinhaVenda" id="pacienteLinhaVenda" hidden="">
<script type="text/javascript">

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

</script>

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

        } 
        );
    } );
    </script>

    <script>
         
    $(document).ready(function() {
        $('#lista').DataTable( {

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

        } 
        );
    } );
    </script>

            <script type="text/javascript">

            $(document).on('click', '#delete',(function() {//using delegaction to send event on dynamic datatable


                    $value=$(this).data("value");
                    //alert($value);
                if (confirm("Clique 'Ok' para eliminar"))
                {
                  $.ajax({
                  url: "{{URL('carapagalinha')}}",
                  type:'post',
                  data: {linha_id:$value, _token: '{{csrf_token()}}',mesa_id:'{{$mesa_id}}'},

                  success: function(data) {
                    //console.log(data);
                    if (data==false) {
                        swal("Erro na eliminação!", "Você não pode remover este iten antes de efectuar pagamento da conta", "error");
                    }else{
                        swal("Linha eliminada com Sucesso!", "Você eliminou um elemento da lista", "success");
                        location.reload(); 
                    }
                    

                       


                }}
                );

                }    


                
            }));
            </script>
              <script type="text/javascript">
                $(document).on('click', '#venda',(function() {//using delegaction to send event on dynamic datatable
                    $value=$(this).data("value");
                    $("#pacienteLinha").val($value[0]);
                    $("#pacienteLinhaVenda").val($value[1]);
                    
                    
                }))

                function releaseVenda($mesa_id, $mesa_name, $linha_id){
                     $paciente=$("#pacienteLinha").val();
                     $tipo_banho=$("#tipo_banho").val();
                     $pacienteLinhaVenda=$('#pacienteLinhaVenda').val();
                    
                          if ($tipo_banho){

                          }
                            else{
                              swal("Erro na Facturação!", "Seleciona o tipo de banho para Facturação", "error");  
                            }
                         
                            
                    




                    $.ajax({
                        url:"{{url('send-banho-venda')}}",
                        type: "get",
                        data:{paciente:$paciente, mesa_id:$mesa_id, tipo_banho:$tipo_banho, pacienteLinhaVenda:$pacienteLinhaVenda},
                        success: function(data){
                            swal("Facturação finalizada com Sucesso", "Encotre a factura no balcão: "+$mesa_name, "success");
                            location.reload(); 
                        }
                    })
                }
              </script>


              <script type="text/javascript">


                $(document).ready(function() {

                  setTimeout(function(){
                    if ($('.alert-success').length > 0) {
                      $('.alert-success').remove();
                    }
                  }, 6000)

                });

              </script>

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
@stop
