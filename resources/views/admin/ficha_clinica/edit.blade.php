@extends('adminlte::page')

@section('title', ' | Edit Ficha do Paciente')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('ficha-clinica') }}"><i class="fa fa-stethoscope"></i> Consultório</a></li>
        <li class="active">Paciente Novo</li>
    </ol>
    <style>
        div > h3{
            font-weight: 600;
        }
    </style>
@stop

@section('content')
<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Nova ficha clínica
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-md-12">
            <form method="post" action="{{route('ficha-clinica.update',$ficha->id)}}" autocomplete="Active" accept-charset="UTF-8" >
                {{ csrf_field() }}


                <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>
                <div class="row">
                    <div class="from-group">
                        <label>Paciente</label>
                         @if(isset($paciente))
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-paw"></i></span>

                            <input  type="text" id=""  name=""  class="form-control" value="{{$paciente->nome}} {{$paciente->caderneta}} - {{$paciente->numero_ficha}} ({{$paciente->cliente->nome}} {{$paciente->cliente->apelido}})" placeholder="" required autofocus disabled>
                            <input type="hidden" id="paciente_id" name="paciente_id" value="{{$paciente->id}}"/>
                          </div>
                         @elseif(isset($ficha))
                         <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-paw"></i></span>

                            <input  type="text" id=""  name=""  class="form-control" value="{{$ficha->paciente->nome}} {{$ficha->paciente->caderneta}} - {{$ficha->paciente->numero_ficha}} ({{$ficha->paciente->cliente->nome}} {{$ficha->paciente->cliente->apelido}})" placeholder="" required autofocus disabled>
                            <input type="hidden" id="paciente_id" name="paciente_id" value="{{$ficha->paciente->id}}"/>
                          </div>
                         @else
                         <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-paw"></i></span>

                            <input  type="text" id="paciente_show"  name="paciente_show"  class="form-control" value="{{old('paciente_show')}}" placeholder="Pesquise pelo nome ou caderneta" required autofocus>
                            <input type="hidden" id="paciente_id" name="paciente_id" value="{{old('paciente_id')}}"/>
                            
                          </div>
                          @endif
                    </div>
                </div>
                <div class="row" >
                        <h4>Anamnese</h4>
                    <hr>

                    
                    <div class="from-group" style="width: 200px">
                        <!--<label>Data</label>-->
                        <input type="hidden" name="d_anamnese" id="d_anamnese" class="form-control" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}"  autofocus >
                    </div>
                </div>

                <div class="row" >
                    <div class="from-group ">
                        <!--<label>Anamnese</label>-->
                        <textarea rows="2" name="anamnese" id="anamnese"  class="form-control"  autofocus>@if(isset($ficha->anamnese)){!!$ficha->anamnese->anamnese!!}@endif</textarea>
                    </div>
                </div>


                <!--//////////////////////////////////////////////////-->

                <div class="row">

                    <div>
                            <h4>Sinais clínicos</h4>
                        <hr>
                    </div>
                    
                    <div class="from-group " style="width: 200px">
                        <!--<label>Data</label>-->
                        <input type="hidden" name="d_sinais_clinicos" id="d_sinais_clinicos" class="form-control" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}" autofocus>
                    </div>
                </div>

                <div class="row" >
                    <div class="from-group ">
                       <!-- <label>Sinais clinicos</label>-->
                        <textarea rows="2" name="sinais_clinicos" id="sinais_clinicos"  class="form-control"  autofocus>@if(isset($ficha->sinais_clinicos)){!!$ficha->sinais_clinicos->sinais_clinicos!!}@endif</textarea>
                    </div>
                </div>


                <!--//////////////////////////////////////////////////-->
                <div class="row">

                    <div >
                            <h4>Exames clínicos</h4>
                        <hr>
                    </div>
                    
                    <div class="from-group " style="width: 200px">
                        <!--<label>Data</label>-->
                        <input type="hidden" name="d_exame" id="d_exame" class="form-control" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}" autofocus>
                    </div>

                </div>
                <div class="row" >
                    <div class="from-group ">
                        <!--<label>Exames clinicos</label>-->
                        <textarea rows="2" name="exame_clinico" id="exame_clinico"  class="form-control"  autofocus>@if(isset($ficha->exame)){!!$ficha->exame->exame_clinico!!}@endif</textarea>
                    </div>
                </div>



                <!--//////////////////////////////////////////////////-->
                <div class="row">

                    <div >
                            <h4>Diagnóstico presuntivo</h4>
                        <hr>
                    </div>
                    
                    <div class="from-group" style="width: 200px">
                        <!--<label>Data</label>-->
                        <input type="hidden" name="d_diagnostico" id="d_diagnostico" class="form-control" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}" autofocus>
                    </div>
                

                </div>

                <div class="row" >
                    <div class="from-group ">
                        <label>Diagnóstico</label>
                        <textarea rows="2" name="diagnostico" id="diagnostico"  class="form-control" autofocus>@if(isset($ficha->diagnostico)){!!$ficha->diagnostico->diagnostico!!}@endif</textarea>
                    </div>
                </div>

                <div class="row" >
                    <div class="from-group ">
                        <label>Tratamento</label>
                        <textarea rows="2" name="tratamento" id="tratamento"  class="form-control"  autofocus>@if(isset($ficha->diagnostico)){!!$ficha->diagnostico->tratamento!!}@endif</textarea>
                    </div>
                </div>



                <!--//////////////////////////////////////////////////-->
                <div class="row">

                    <div >
                            <h4>Observações</h4>
                        <hr>
                    </div>
                    
                    <div class="from-group " style="width: 200px">
                        <!--<label>Data</label>-->
                        <input type="hidden" name="d_observacoes" id="d_observacoes" class="form-control" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}" autofocus>
                    </div>

                </div>
                <div class="row" >
                    <div class="from-group ">
                       <!-- <label>Observações</label>-->
                        <textarea rows="2" name="observacao" id="observacao"  class="form-control"  autofocus>@if(isset($ficha->observacao)){!!$ficha->observacao->observacao!!}@endif</textarea>
                    </div>
                </div>

                <div class="row">

                    <div >
                            <h4>Peso</h4>
                        <hr>
                    </div>
                    
                    <div class="from-group " style="width: 200px">
                        <!--<label>Data</label>-->
                        <input type="hidden" name="d_peso" id="d_peso" class="form-control" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}" autofocus>
                    </div>

                </div>
                <div class="row" >
                    <div class="from-group ">
                        <!--<label>Peso</label>-->
                        <input type="number" step="any" name="peso" id="peso"  class="form-control" value="@if(isset($ficha->peso)){!!$ficha->peso->peso!!}@endif" autofocus> 
                    </div>
                </div>




                <div class="row" >

                    <div class="from-group text-right " style="width:80px">
                        <label></label>
                        <input class="btn btn-primary" type="submit" value="Atualizar">
                    </div>
                </div>         
                   
        </form>
        

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
    $('#paciente_show').autocomplete({
        delay: 500,// this is in milliseconds
        minLength: 2,
        source: function(request, response) {

            $.getJSON("{{url('search-pacient')}}", {
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

            $('input[name="paciente_show"]').val(ui.item.label);
            $('input[name="paciente_id"]').val(ui.item.id);
        }
    });
    })
</script>

@section('css')

@stop
@stop
