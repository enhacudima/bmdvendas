@extends('adminlte::page')

@section('title', 'Calendario')



@section('content_header')

   
@stop

@section('content')
    <div class="">
        <div class="box box-solid box-primary">
            <div class="box-header with-border"><b><center><i class="fa fa-calendar-plus-o"></i> Adicionar Evento ao Calendário </center></b></div>
            <div class="box-body">
                {!! Form::open(array('route'=>'calendario.add','method'=>'POST','files'=>'true'))!!}
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

                    <div class="col-xs-4 col-sm-4 col-ms-4">
                        <div class="form-group">
                            {!!Form::label('titulo','Título do Evento:')!!}
                            <div class="">
                            {!!Form::text('titulo',null, ['class'=>'form-control']) !!}
                            {!! $errors->first('titulo', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-ms-3">
                        <div class="form-group">
                            {!!Form::label('data_inicio','Data Início:')!!}
                            <div class="">
                            {!!Form::date('data_inicio',null, ['class'=>'form-control'], 'd/m/Y') !!}
                            {!! $errors->first('data_inicio', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-3 col-sm-3 col-ms-3">
                        <div class="form-group">
                            {!!Form::label('data_final','Data Final:')!!}
                            <div class="">
                            {!!Form::date('data_final',date('D-m-y'), ['class'=>'form-control']) !!}
                            {!! $errors->first('data_final', '<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-1 col-sm-1 col-md-1 text-center"> &nbsp;</br/>
                     {!! Form::button('<i class="fa fa-save"></i> Submit', ['id'=>'add-new-event','class'=>'btn btn-danger', 'type'=>'submit']) !!} 
                    </div>
<!--'id'=>'add-new-event'-->
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="box box-solid box-primary">
            <div class="box-header with-border"> <center><i class="fa fa-calendar"></i> Calendário</center></div>
                <div class="box-body">
                  
                     {!! $calendario_detalhes->calendar()!!}
                  
                </div>
        </div>
        
    </div>




  {!!  $calendario_detalhes->script() !!}


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