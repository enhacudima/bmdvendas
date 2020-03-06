@extends('adminlte::page')

@section('title', ' | Cadastro de Sala')

@section('content_header')
    <h1>Settings</h1>
    <style>
        .user_name{
            font-size:14px;
            font-weight: bold;
        }
        .comments-list .media{
            border-bottom: 1px dotted #ccc;
        }
    </style>
@stop

@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<div class="">
    <div class="">
    <div class="panel panel-default">

    <div class="panel-heading">
        <h4>Nova ficha clinica
        </h4>
    </div>

    <div class="panel-body">
    

    <div class="col-lg-12">
    <div class="panel panel-default">

        
    <table id="reclatodas" class="table table-striped  table-hover" cellspacing="0" width="100%">
        <thead >
            <tr>
                <th>
                    <div class="btn-group">
                        <a href="{{route('ficha-clinica.create')}}" class="btn btn-primary">
                            Novo fica clínica <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </th>
            </tr>
            <tr>
                <th scope="col">Ficha clínica</th>
            </tr>
        </thead>

        <tbody>
        <tr>
            <td>
                <a href="#">
                    <div class="media">
                        <p class="pull-right"><small>5 days ago</small></p>
                        <div class="media-body">

                            <h4 class="media-heading user_name">Vasco Dagama</h4>
                            Dog Bu

                        </div>
                        <i><small><a href="">Clique aqui para ver com mais detalhes...</a></small></i>
                    </div>
                </a>
            </td>
        </tr>


        <tr>
            <td>
                <a href="#">
                    <div class="media">
                        <p class="pull-right"><small>5 days ago</small></p>
                        <div class="media-body">

                            <h4 class="media-heading user_name">Baltej Singh</h4>
                            João Tocuene
                        </div>
                        <i><small><a href="">Clique aqui para ver com mais detalhes...</a></small></i>
                    </div>
                </a>
            </td>
        </tr>


        @if(isset($fichas_clinicas))
        @foreach($fichas_clinicas as $cil)
            <tr>
             <td>
                 <div class="comments-list">
                <a class="btn btn btn-success btn-xs" href="{{route('ficha-clinica.edit', $cil->id)}}">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="page-header">
                                    <h1><small class="pull-right">45 comments</small> Comments </h1>
                                </div>
                                <div class="comments-list">
                                    <div class="media">
                                        <p class="pull-right"><small>5 days ago</small></p>
                                        <a class="media-left" href="#">
                                            <img src="http://lorempixel.com/40/40/people/1/">
                                        </a>
                                        <div class="media-body">

                                            <h4 class="media-heading user_name">Baltej Singh</h4>
                                            Wow! this is really great.

                                            <p><small><a href="">Like</a> - <a href="">Share</a></small></p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <p class="pull-right"><small>5 days ago</small></p>
                                        <a class="media-left" href="#">
                                            <img src="http://lorempixel.com/40/40/people/2/">
                                        </a>
                                        <div class="media-body">

                                            <h4 class="media-heading user_name">Baltej Singh</h4>
                                            Wow! this is really great.

                                            <p><small><a href="">Like</a> - <a href="">Share</a></small></p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <p class="pull-right"><small>5 days ago</small></p>
                                        <a class="media-left" href="#">
                                            <img src="http://lorempixel.com/40/40/people/3/">
                                        </a>
                                        <div class="media-body">

                                            <h4 class="media-heading user_name">Baltej Singh</h4>
                                            Wow! this is really great.

                                            <p><small><a href="">Like</a> - <a href="">Share</a></small></p>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <p class="pull-right"><small>5 days ago</small></p>
                                        <a class="media-left" href="#">
                                            <img src="http://lorempixel.com/40/40/people/4/">
                                        </a>
                                        <div class="media-body">

                                            <h4 class="media-heading user_name">Baltej Singh</h4>
                                            Wow! this is really great.

                                            <p><small><a href="">Like</a> - <a href="">Share</a></small></p>
                                        </div>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                </a>
                 </div>
            </td>
            </tr>
        @endforeach
        @endif
        </tbody>
        <tfoot>
            <tr>
                <th>
                    <div class="btn-group">
                        <a href="{{route('ficha-clinica.create')}}" class="btn btn-primary">
                            Novo fica clínica <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </th>
            </tr>
        </tfoot>
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
