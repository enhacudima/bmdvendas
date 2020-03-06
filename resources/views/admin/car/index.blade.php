@extends('adminlte::page')

@section('title', ' | Banho admin')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--sweetalert-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Serviço de Banho
        </h4>
    </div>

    <div class="panel-body">

        <div class="col-lg-4">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Lista de Animais
                    <a href="{{ url('carcreate',$mesa_id) }}" class="btn btn-success btn-xs pull-right">Criar um novo PET</a>
                </h4>
            </div>

            <div class="panel-body">

            <div class="box-body table-responsive no-padding">      
            <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
                <thead >
                <tr>     
                    <th scope="col">Caderneta</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Contacto</th>
                    <th scope="col">Animal</th>
                    <th scope="col">Data</th>  
                    <th scope="col">Acção</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($car))    
                @foreach($car as $cil)
                    <tr>
                     <td>             
                        <a class="btn btn btn-success btn-xs" href="{{url('carshow', [$cil->id,$mesa_id])}}">
                            <i class="fa fa-pencil fa-fw"></i> {{$cil->matricula}}
                        </a>
                     </td> 
                     <td>{{$cil->name}} {{$cil->sname}}</td>
                     <td>{{$cil->contacto1}} {{$cil->contacto2}}</td>
                     <td>{{$cil->marca}}</td>
                     <td>{{$cil->updated_at}}</td>
                     <td> 

                        <a class="btn btn btn-success btn-xs"   href="{{url('cartemp', [$cil->id,$mesa_id,Auth::user()->id])}}">
                             Espera >>
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
        </div>

        <div class="col-lg-8">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h4>Fila de Espera
                </h4>
            </div>

            <div class="panel-body">

            <div class="box-body table-responsive no-padding">     
            <table id="lista" class="table table-striped  table-hover" cellspacing="0" width="100%">
                <thead >
                <tr>     
                    <th scope="col">Caderneta</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Contacto</th>
                    <th scope="col">Animal</th>
                    <th scope="col">Data</th>
                    <th scope="col">Notificar</th>
                    <th scope="col">Venda</th>
                    <th scope="col">Eliminar</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($car_temp))    
                @foreach($car_temp as $cil)
                    <tr>
                     <td>{{$cil->matricula}}</td> 
                     <td>{{$cil->name}} {{$cil->sname}}</td>
                     <td>{{$cil->contacto1}} {{$cil->contacto2}}</td>
                     <td>{{$cil->marca}}</td>
                     <td>{{$cil->updated_at->diffForHumans()}}</td>
                     <td> 

                        <a class="btn btn btn-success btn-xs"   href="{{url('cartemp', [$cil->id,$mesa_id,Auth::user()->id])}}">
                            SMS
                        </a>
                     </td> 
                     <td> 

                        <a class="btn btn btn-success btn-xs"   href="{{url('carvendasindex', [$cil->id,$mesa_id,Auth::user()->id])}}">
                            Serviços
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
        </div>



        

        

</div>

</div>
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
                if (confirm("Clique 'Ok' para eliminar o carro"))
                {
                  $.ajax({
                  url: "{{URL('carapagalinha')}}",
                  type:'post',
                  data: {linha_id:$value, _token: '{{csrf_token()}}',mesa_id:'{{$mesa_id}}'},

                  success: function(data) {
                    console.log(data);
                    if (data==false) {
                        swal("Erro na eliminação!", "Você não pode remover este iten antes de efectuar pagamento da conta", "error");
                    }else{
                        swal("Carro eliminado com Sucesso!", "Você eliminou um carro da lista", "success");
                        location.reload(); 
                    }
                    

                       


                }}
                );

                }    


                
            }));
            </script>

              <script type="text/javascript">


                $(document).ready(function() {

                  setTimeout(function(){
                    if ($('.alert-success').length > 0) {
                      $('.alert-success').remove();
                    }
                  }, 5000)

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
