@extends('adminlte::page')

@section('title', ' | Ficha Show')

@section('content_header')
    <h1><a class="btn btn-social-icon btn-github"  href="{{ url()->previous() }}"><i class="fa  fa-arrow-left"></i></a>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="{{ url('ficha-clinica') }}"><i class="fa fa-stethoscope"></i> Consultório</a></li>
        <li class="active">Ficha Show</li>
    </ol>
@stop

@section('content')

          <!-- Box Comment -->
          <div class="box box-widget ">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="{{asset('storage/'.$ficha->user->avatar)}}" alt="User Image">
                <span class="username"><a href="#">[{{$ficha->id}}] {{$ficha->user->name}}</a></span>
                <span class="description">{{$ficha->paciente->nome}} {{$ficha->paciente->numero_ficha}} {{$ficha->paciente->caderneta}} - {{$ficha->created_at->diffForHumans()}}</span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="box-comments panel-body" >

              <div class=" col-md-6" >
               
                    <div class="col-md-12">
                        <div class="col-md-6">

                            
                            <strong>Estado</strong>:
                            @if($ficha->status=="0")
                            <span style="color: #25b347">
                                Aberto
                            </span>
                            @else
                            @if($ficha->status=="1")
                            <span style="color: #25b347">
                                Internamento
                            </span>
                            @else
                            @if($ficha->status=="2")
                            <span style="color: #ef1908">
                                <label class="control-label" style="color: #00a65a"><i class="fa fa-check"></i> <i> Alta</i></label>
                            </span>
                            @else
                            @if($ficha->status=="3")
                            <span style="color: #ef1908">
                                Óbto
                            </span>
                            @endif
                            @endif
                            @endif
                            @endif

                            <br /> 
                            @if($ficha->internamento_in)
                            <strong><i class="fa fa-clock-o" ></i> Tempo de internamento: 
                                {{\Carbon\Carbon::parse($ficha->internamento_in)->DiffInDays(\Carbon\Carbon::parse($ficha->internamento_out))}} Dias</strong>  
                            @endif
                            


                        </div>
                        <div class="col-md-6">
                            <strong>Cliente</strong>: {{$ficha->paciente->cliente->nome}} {{$ficha->paciente->cliente->apelido}}<br/>
                            <strong>Nuit</strong>: {{$ficha->paciente->cliente->nuit}}<br/>
                            <strong>Morada</strong>: {{$ficha->paciente->cliente->endereco}}<br/>
                            <strong>Email</strong>: {{$ficha->paciente->cliente->email}}<br/>
                            <strong>Contacto 1</strong>: {{$ficha->paciente->cliente->contacto1}}<br/>
                            <strong>Contacto 2</strong>: {{$ficha->paciente->cliente->contacto2}}<br/>
                        </div>
                 
                </div>
            </div>

              <div class="col-md-6" >
                    <div class="col-md-12">
                        <div class="col-md-6">
                           
                            <strong>Paciente</strong>: {{$ficha->paciente->nome}}<br/>
                            <strong>Espece</strong>: {{$ficha->paciente->especie}} <br/>
                            <strong>Raça</strong>: {{$ficha->paciente->raca}} <br/>
                            <strong>Sexo</strong>: {{$ficha->paciente->sexo}} <br/>
                            <strong>Pelagem</strong>: {{$ficha->paciente->pelagem}} <br/>
                            <strong>Idade</strong>: {{\Carbon\Carbon::parse($ficha->paciente->idade)->DiffInMonths(\Carbon\Carbon::today())}} Mêses<br/>
                        </div>

                        <div class="col-md-6">
                        </div>
                    </div>
            </div>


            </div>
            @if(isset($ficha->anamnese))
              <p>
                 <div class="col-md-12 box-footer box-comments" style="margin-bottom:13px">
                    <div class="col-md-12 fot textjusty ">
                        <span class="text-muted pull-right">{{$ficha->anamnese->updated_at->diffForHumans()}} - {{$ficha->anamnese->updated_at->format('d/M/Y')}}</span>
                        <strong>Anamnese</strong><br>
   
                        {!!$ficha->anamnese->anamnese!!}

                    </div>
                 </div>
              </p>
            @endif
            @if((isset($ficha->sinais_clinicos)))  
              <p>
                 <div class="col-md-12 box-footer box-comments" style="margin-bottom:13px">
                    <div class="col-md-12 fot textjusty ">
                        <span class="text-muted pull-right">{{$ficha->sinais_clinicos->updated_at->diffForHumans()}} - {{$ficha->sinais_clinicos->updated_at->format('d/M/Y')}}</span>
                        <strong>Sinais Clinicos</strong><br>
   
                        {!!$ficha->sinais_clinicos->sinais_clinicos!!}

                    </div>
                 </div>
              </p>
             @endif
             @if((isset($ficha->exame))) 
              <p>
                 <div class="col-md-12 box-footer box-comments" style="margin-bottom:13px">
                    <div class="col-md-12 fot textjusty ">
                        <span class="text-muted pull-right">{{$ficha->exame->updated_at->diffForHumans()}} - {{$ficha->exame->updated_at->format('d/M/Y')}}</span>
                        <strong>Exames</strong><br>
   
                        {!!$ficha->exame->exame!!}

                    </div>
                 </div>
              </p>
              @endif
              @if((isset($ficha->diagnostico)))
              <p>
                 <div class="col-md-12 box-footer box-comments" style="margin-bottom:13px">
                    <div class="col-md-12 fot textjusty ">
                        <span class="text-muted pull-right">{{$ficha->diagnostico->updated_at->diffForHumans()}} - {{$ficha->diagnostico->updated_at->format('d/M/Y')}}</span>
                        <strong>Diagnostico</strong><br>
   
                        {!!$ficha->diagnostico->diagnostico!!}

                    </div>
                 </div>
              </p>
              @endif
              @if((isset($ficha->observacao)))
              <p>
                 <div class="col-md-12 box-footer box-comments" style="margin-bottom:13px">
                    <div class="col-md-12 fot textjusty ">
                        <span class="text-muted pull-right">{{$ficha->observacao->updated_at->diffForHumans()}} - {{$ficha->observacao->updated_at->format('d/M/Y')}}</span>
                        <strong>Observação</strong><br>
   
                        {!!$ficha->observacao->observacao!!}

                    </div>
                 </div>
              </p>
              @endif
              @if((isset($ficha->peso)))
              <p>
                 <div class="col-md-12 box-footer box-comments" style="margin-bottom:13px">
                    <div class="col-md-12 fot textjusty ">
                        <span class="text-muted pull-right">{{$ficha->peso->updated_at->diffForHumans()}} - {{$ficha->peso->updated_at->format('d/M/Y')}}</span>
                        <strong>Peso</strong><br>
   
                        {!!$ficha->peso->peso!!}

                    </div>
                 </div>
              </p>
              @endif
              <a type="button" class="btn btn-default btn-xs " href="{{route('ficha-clinica.edit',$ficha->id)}}" ><i class="fa fa-pencil-square-o"></i> Editar</a>
              <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-warning"><i class="fa fa-wrench"></i> Estado</button>
              <a type="button" class="btn btn-default btn-xs " href="{{url('ficha-clinica/seguimento',$ficha->id)}}" ><i class="fa fa-plus"></i> Nova consulta </a>
            </div>


            <!-- /.comentarios -->
            <div class="box-footer box-comments">
                @if(isset($sub_ficha))
                @include('admin.ficha_clinica.parent', ['sub_ficha' => $sub_ficha, 'ficha_id' => $ficha->id])

                {!! $sub_ficha->render() !!}
                @endif
            </div>
          </div>
          <!-- /.box -->

          <!--model estato-->
          <div class="modal modal-warning fade" id="modal-warning" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Alterar estado da ficha</h4>
              </div>
            <form method="post" action="{{url('ficha_clinica/altera/estado')}}">
            @csrf
              <div class="modal-body">
                <input type="" name="id" hidden="" value="{{$ficha->id}}">
                <p> <input type="radio" name="status" value="0"><label>Aberto</label> </p>
                <p> <input type="radio" name="status" value="1"><label>Internamento</label> </p>
                <p> <input type="radio" name="status" value="2"><label>Alta</label> <small>É necessario uma facturação</small></p>
                <p> <input type="radio" name="status" value="3"><label>Óbto</label></p>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Canselar</button>
                <button type="submit" class="btn btn-outline">Salvar altarações</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

@section('css')

@stop
@stop
