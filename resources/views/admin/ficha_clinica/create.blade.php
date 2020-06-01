@extends('adminlte::page')

@section('title', ' | Nova Ficha')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
        <a class="btn btn-social-icon btn-github"  href="{{ url('tags') }}"><i class="fa  fa-cog"></i></a>
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
            <form method="post" action="{{route('ficha-clinica.store')}}" autocomplete="Active" accept-charset="UTF-8" >
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
                            <input type="hidden" id="parent_id" name="parent_id" value="{{$ficha->id}}"/>
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
                        <h4>Tags</h4>
                    <hr>
                </div>

                <div class="row" >
                    <div class="from-group ">
                        <!--<label>Anamnese</label>-->
                        <select id="tag_list" name="tag_list[]" class="form-control" multiple style="width: 100%; "></select>

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
                        <textarea rows="2" name="anamnese" id="anamnese"  class="form-control"  autofocus>{{old('anamnese')}}</textarea>
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
                        <textarea rows="2" name="sinais_clinicos" id="sinais_clinicos"  class="form-control"  autofocus>{{old('sinais_clinicos')}}</textarea>
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
                        <textarea rows="2" name="exame_clinico" id="exame_clinico"  class="form-control"  autofocus>{{old('exame_clinico')}}</textarea>
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
                        <textarea rows="2" name="diagnostico" id="diagnostico"  class="form-control" autofocus>{{old('diagnostico')}}</textarea>
                    </div>
                </div>

                <div class="row" >
                    <div class="from-group ">
                        <label>Tratamento</label>
                        <textarea rows="2" name="tratamento" id="tratamento"  class="form-control"  autofocus>{{old('tratamento')}}</textarea>
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
                        <textarea rows="2" name="observacao" id="observacao"  class="form-control"  autofocus>{{old('observacao')}}</textarea>
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
                        <input type="number" step="any" name="peso" id="peso"  class="form-control" value="{{old('peso')}}" autofocus> 
                    </div>
                </div>

                <div class="row">
                    <div >
                            <h4>Agendamento</h4>
                        <hr>
                    </div>
                        <div class="">
                            <div class="box box-solid box-primary">
                                <div class="box-header with-border"><b><center><i class="fa fa-calendar-plus-o"></i> Adicionar Evento ao Calendário </center></b></div>
                                <div class="box-body">
                                    
                                    <input type="hidden" name="cor" id="cor" />
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                        <strong><h5>Cor do Evento</h5></strong>
                                        <ul class="fc-color-picker" id="color-chooser">
                                        <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                                        <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                                        </ul>
                                  
                                        @if (Session::has('danger'))
                                        <div class="alert alert-danger">{{ Session::get('danger') }}</div>
                                        @elseif (Session::has('warnning'))
                                        <div class="alert alert-danger">{{ Session::get('warnning')}}</div>
                                        @endif
                                        </div>
                                        <div class="row col-md-12">
                                        <div class="col-xs-12 col-sm-12 col-ms-12">
                                            <div class="form-group">
                                                {!!Form::label('titulo','Título do Evento:')!!}
                                                <div class="">
                                                {!!Form::text('titulo',null, ['class'=>'form-control']) !!}
                                                {!! $errors->first('titulo', '<p class="alert alert-danger">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!!Form::label('data_inicio','Data Início:')!!}
                                                <div class="">
                                                <input type="datetime-local" id="data_inicio" name="data_inicio" class="form-control" value="{{old('data_inicio')}}">
                                                {!! $errors->first('data_inicio', '<p class="alert alert-danger">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!!Form::label('data_final','Data Final:')!!}
                                                <div class="">
                                                <input type="datetime-local" id="data_final" name="data_final" class="form-control" value="{{old('data_final')}}">
                                                {!! $errors->first('data_final', '<p class="alert alert-danger">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    
                </div>




                <div class="row" >

                    <div class="from-group text-right " style="width:80px">
                                                              
                        <div class="text-center"> &nbsp;</br/>
                         {!! Form::button('<i class="fa fa-save"></i> Submit', ['id'=>'add-new-event','class'=>'btn btn-danger', 'type'=>'submit']) !!} 
                        </div>
                    </div>
                </div>         
                   
        </form>
        

    </div>

</div>

</div>

 <script>
    $('#tag_list').select2({
        placeholder: "Seleciona as tags...",
        minimumInputLength: 2,
        ajax: {

            url: '{{URL::to('/tags/find')}}',
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
</script>

<script type="text/javascript">

$(document).ready(function(){
  $('#cor').val("rgb(255, 133, 27)"); 
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

<script>
  $(function () {

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#cor').val(currColor);  
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
  })


</script>

@section('css')

@stop
@stop
