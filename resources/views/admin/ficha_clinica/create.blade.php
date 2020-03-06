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
        <h4>Nova ficha clínica
        </h4>
    </div>

    <div class="panel-body">
        <div class="col-md-12">
            <form method="post" action="{{route('ficha-clinica.store')}}" autocomplete="Active" accept-charset="UTF-8" >
                {{ csrf_field() }}


                <input   name="user_id" type="hidden" id="user_id" value="{{ Auth::user()->id }}" required autofocus>
                <div class="row">
                    <strong>
                        <h3>Anamnese</h3>
                    </strong>
                    <hr>


                    <div class="from-group col-md-2">
                        <label>Data</label>
                        <input type="date" name="d_anamnese" id="d_anamnese" class="form-control" value="{{old('d_anamnese')}}" autofocus>
                    </div>
                </div>

                <div class="row" style="padding-top: 20px">
                    <div class="from-group col-md-4">
                        <label>Sinais clinicos</label>
                        <textarea rows="3" name="anamnese" id="anamnese"  class="form-control" value="{{old('anamnese')}}" autofocus></textarea>
                    </div>
                </div>


                <!--//////////////////////////////////////////////////-->

                <div class="row">

                    <div style="padding-top: 30px;">
                        <strong>
                            <h3>Sinais clínicos</h3>
                        </strong>
                        <hr>
                    </div>

                    <div class="from-group col-md-2">
                        <label>Data</label>
                        <input type="date" name="d_sinais_clinicos" id="d_sinais_clinicos" class="form-control" value="{{old('d_sinais_clinicos')}}" autofocus>
                    </div>
                </div>

                <div class="row" style="padding-top: 20px">
                    <div class="from-group col-md-4">
                        <label>Sinais clinicos</label>
                        <textarea rows="3" name="sinais_clinicos" id="sinais_clinicos"  class="form-control" value="{{old('sinais_clinicos')}}" autofocus></textarea>
                    </div>
                </div>


                <!--//////////////////////////////////////////////////-->
                <div class="row">

                    <div style="padding-top: 30px;">
                        <strong>
                            <h3>Exames clínicos</h3>
                        </strong>
                        <hr>
                    </div>

                    <div class="from-group col-md-2">
                        <label>Data</label>
                        <input type="date" name="d_exame" id="d_exame" class="form-control" value="{{old('d_exame')}}" autofocus>
                    </div>

                </div>
                <div class="row" style="padding-top: 20px">
                    <div class="from-group col-md-4">
                        <label>Exames clinicos</label>
                        <textarea rows="3" name="exame_clinico" id="exame_clinico"  class="form-control" value="{{old('exame_clinico')}}" autofocus></textarea>
                    </div>
                </div>



                <!--//////////////////////////////////////////////////-->
                <div class="row">

                    <div style="padding-top: 30px;">
                        <strong>
                            <h3>Diagnóstico presuntivo</h3>
                        </strong>
                        <hr>
                    </div>

                    <div class="from-group col-md-2">
                        <label>Data</label>
                        <input type="date" name="d_diagnostico" id="d_diagnostico" class="form-control" value="{{old('d_diagnostico')}}" autofocus>
                    </div>

                </div>

                <div class="row" style="padding-top: 20px">
                    <div class="from-group col-md-4">
                        <label>Diagnóstico</label>
                        <textarea rows="3" name="diagnostico" id="diagnostico"  class="form-control" value="{{old('diagnostico')}}" autofocus></textarea>
                    </div>
                </div>

                <div class="row" style="padding-top: 20px">
                    <div class="from-group col-md-4">
                        <label>Tratamento</label>
                        <textarea rows="3" name="tratamento" id="tratamento"  class="form-control" value="{{old('tratamento')}}" autofocus></textarea>
                    </div>
                </div>



                <!--//////////////////////////////////////////////////-->
                <div class="row">

                    <div style="padding-top: 30px;">
                        <strong>
                            <h3>Observações</h3>
                        </strong>
                        <hr>
                    </div>

                    <div class="from-group col-md-2">
                        <label>Data</label>
                        <input type="date" name="d_observacoes" id="d_observacoes" class="form-control" value="{{old('d_observacoes')}}" autofocus>
                    </div>

                </div>
                <div class="row" style="padding-top: 20px">
                    <div class="from-group col-md-4">
                        <label>Observações</label>
                        <textarea rows="3" name="observacao" id="observacao"  class="form-control" value="{{old('observacao')}}" autofocus></textarea>
                    </div>
                </div>




                            <div class="row">

                                <div class="from-group text-right col-md-4">
                                     <label></label>
                                    <input class="btn btn-primary" type="submit" value="Cadastrar">
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
