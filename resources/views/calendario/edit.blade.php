@extends('adminlte::page')

@section('title', 'Calendario')



@section('content_header')

   
@stop

@section('content')
    <div class="container">
        <div class="box box-solid box-danger">
            <div class="box-header with-border"><b><center><i class="fa fa-calendar-plus-o"></i> Alterar Evento no Calendário </center></b></div>
            <div class="box-body">
                {!! Form::open(array('url'=>'calendario/detalhes/update/'.$event->id,'method'=>'POST','files'=>'true'))!!}
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
                    </div>
                    <div class="row col-xs-12 col-sm-12 col-ms-12">
                    <div class="col-xs-12 col-sm-12 col-ms-12">
                        <div class="form-group">
                            {!!Form::label('titulo','Título do Evento:')!!}
                            <div class="">
                            {!!Form::text('titulo',$event->titulo, ['class'=>'form-control']) !!}
                            {!! $errors->first('titulo', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                      
                    </div>

                    <div class="col-xs-2 col-sm-2 col-ms-2">
                        <div class="form-group">
                            {!!Form::label('data_inicio','Data Início:')!!}
                            <div class="">
                            {!!Form::date('data_inicio',$event->data_inicio, ['class'=>'form-control'], 'd/m/Y') !!}
                            {!! $errors->first('data_inicio', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-2 col-sm-2 col-ms-2">
                        <div class="form-group">
                            {!!Form::label('data_final','Data Final:')!!}
                            <div class="">
                            {!!Form::date('data_final',$event->data_final, ['class'=>'form-control']) !!}
                            {!! $errors->first('data_final', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-1 col-sm-1 col-ms-1">
                        <div class="form-group">
                            {!!Form::label('concluido','Concluido:')!!}
                            <div class="">
                            {!!Form::checkbox('concluido','concluido', false) !!}
                            {!! $errors->first('concluido', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row col-xs-12 col-sm-12 col-ms-12">
                    <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;</br/>
                     {!! Form::button('<i class="fa fa-save"></i> Update', ['id'=>'add-new-event','class'=>'btn btn-danger', 'type'=>'submit']) !!} 
                    </div>

                    <div class="col-xs-1 col-sm-1 col-md-1 text-center">&nbsp;</br/>
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

@stop

