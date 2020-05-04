@extends('adminlte::page')

@section('title', 'Calendario')



@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active"><a href="{{ url('calendario') }}"><i class="fa fa-calendar-plus-o"></i> Calendário</a></li>
    </ol>
   
@stop

@section('content')
    <div class="">
        <div class="box box-solid box-primary">
            <div class="box-header with-border"><b><center><i class="fa fa-calendar-plus-o"></i> Alterar Evento no Calendário </center></b></div>
            <div class="box-body">
                {!! Form::open(array('url'=>'calendario/detalhes/update/'.$event->id,'method'=>'POST','files'=>'true'))!!}
                <input type="hidden" name="cor" id="cor" value="{{$event->cor}}" />
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
                    </div>
                    <div class="row col-md-12">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!!Form::label('titulo','Título do Evento:')!!}
                            <div class="">
                            {!!Form::text('titulo',$event->titulo, ['class'=>'form-control']) !!}
                            {!! $errors->first('titulo', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                      
                    </div>
                    <div class="col-ms-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!!Form::label('data_inicio','Data Início:')!!}
                            <div class="">
                            {!!Form::date('data_inicio',$event->data_inicio, ['class'=>'form-control'], 'd/m/Y') !!}
                            {!! $errors->first('data_inicio', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!!Form::label('data_final','Data Final:')!!}
                            <div class="">
                            {!!Form::date('data_final',$event->data_final, ['class'=>'form-control']) !!}
                            {!! $errors->first('data_final', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!!Form::label('concluido','Concluido:')!!}
                            <div class="">
                            {!!Form::checkbox('concluido','concluido', false) !!}
                            {!! $errors->first('concluido', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>


                    <div class="row col-md-12">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-paw"></i></span>

                                @if(isset($event->paciente->nome))
                                <input  type="text" id="paciente_show"   class="form-control" value="{{$event->paciente->nome}} {{$event->paciente->caderneta}} - {{$event->paciente->numero_ficha}} ({{$event->paciente->cliente->nome}} {{$event->paciente->cliente->apelido}})" placeholder="Pesquise pelo nome ou caderneta"  autofocus>
                                @else
                                <input  type="text" id="paciente_show"   class="form-control" value="" placeholder="Pesquise pelo nome ou caderneta"  autofocus>

                                @endif
                                <input type="hidden" id="paciente_id" name="paciente_id" value="{{$event->paciente_id}}"/>
                                
                              </div>
                            </div>
                    </div>

                    <div class="row col-md-5">
                        <div class="col-md-2 text-center"> &nbsp;</br/>
                         {!! Form::button('<i class="fa fa-save"></i> Update', ['id'=>'add-new-event','class'=>'btn btn-danger', 'type'=>'submit']) !!} 
                        </div>

                        <div class="col-md-2 text-center">&nbsp;</br/>
                          <a href="{{url('calendario/delete/'.$event->id)}}" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a>
                        </div>
                    </div>
<!--'id'=>'add-new-event'-->
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

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

            $('input[id="paciente_show"]').val(ui.item.label);
            $('input[name="paciente_id"]').val(ui.item.id);
        }
    });
    })
</script>

@stop

