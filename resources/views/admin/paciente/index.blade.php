@extends('adminlte::page')

@section('title', ' | Cadastro de Sala')

@section('content_header')
    <h1>Settings</h1>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Novo paciente
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-lg-3">
                        <form method="post" action="{{route('paciente.store')}}" autocomplete="Active" accept-charset="UTF-8" >
                            {{ csrf_field() }}

                            <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Cliente</label>
                                    <select name="cliente_id" id="cliente_id" class="form-control" value="{{old('cliente_id')}}" required autofocus>
                                        <option disabled selected ></option>
                                        @if(isset($clientes))
                                            @foreach($clientes as $data)
                                                <option value="{{$data->id}}">{{$data->nome}} {{$data->apelido}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Nome do paciente</label>
                                        <input type="text" name="nome" id="nome" class="form-control" value="{{old('nome')}}" required autofocus>
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Especie</label>
                                        <select name="especie" id="especie" class="form-control" value="{{old('especie')}}" required autofocus>
                                            <option disabled selected ></option>
                                            @if(isset($especies))
                                                @foreach($especies as $data)
                                                    <option value="{{$data->nome}}">{{$data->nome}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                            </div>

                            <div class="row">
                                    <div class="from-group col-lg-12">
                                        <label>Raça</label>
                                        <select name="raca" id="raca" class="form-control" value="{{old('raca')}}" required autofocus>
                                            <option disabled selected ></option>
                                            @if(isset($racas))
                                                @foreach($racas as $data)
                                                    <option value="{{$data->nome}}">{{$data->nome}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Sexo</label>
                                    <select name="sexo" id="sexo" class="form-control" value="{{old('sexo')}}" required autofocus>
                                        <option disabled selected ></option>
                                        <option value="M">Macho</option>
                                        <option value="F">Fémia</option>
                                        <option value="O">Outro</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Idade</label>
                                    <input type="number" name="idade" id="idade" class="form-control" value="{{old('idade')}}"  autofocus>
                                </div>
                            </div>

                            <div class="row">
                                <div class="from-group col-lg-12">
                                    <label>Pelagem</label>
                                    <select name="pelagem" id="pelagem" class="form-control" value="{{old('pelagem')}}" required autofocus>
                                        <option disabled selected ></option>
                                        <option value="branca">Branca</option>
                                        <option value="castanha">Castanha</option>
                                        <option value="preta">Preta</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row">

                                <div class="from-group text-right col-md-12">
                                     <label></label>
                                    <input class="btn btn-primary" type="submit" value="Cadastrar">
                                </div>
                            </div>         
                           
                        </form>
        

    </div>
    

    <div class="col-lg-9">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Lista de pacientes
        </h4>
    </div>

    <div class="panel-body">

        
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
        <tr>
            <th scope="col">#</th>
            <th scope="col">Cliente</th>
            <th scope="col">Paciente</th>
            <th scope="col">Especie</th>
            <th scope="col">Raça</th>
            <th scope="col">Sexo</th>
            <th scope="col">Idade</th>
            <th scope="col">Pelagem</th>
            <th scope="col">Data de atualização</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($pacientes))
        @foreach($pacientes as $cil)
            <tr>
             <td>{{$cil->id}}</td>
             <td>{{$cil->cliente_id}}</td>
             <td>
                <a class="btn btn btn-success btn-xs" href="{{route('paciente.edit', $cil->id)}}">
                    <i class="fa fa-pencil fa-fw"></i> {{$cil->nome}}
                </a>
            </td>
             <td>{{$cil->especie}}</td>
             <td>{{$cil->raca}}</td>
             <td>{{$cil->sexo}}</td>
             <td>{{$cil->idade}}</td>
             <td>{{$cil->pelagem}}</td>
             <td>{{$cil->updated_at}}</td>
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
